<?php
namespace App\Services;

use App\Services\Interfaces\LicenseServiceInterface;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Interfaces\LicenseRepositoryInterface as LicenseRepository;
use App\Repositories\Interfaces\NotificationRepositoryInterface as NotificationRepository;

class LicenseService extends BaseService implements LicenseServiceInterface
{
	protected $licenseRepository;
    protected $notificationRepository;
	
	public function __construct(LicenseRepository $licenseRepository, NotificationRepository $notificationRepository)
	{
		$this->licenseRepository = $licenseRepository;
        $this->notificationRepository = $notificationRepository;
	}
	public function create(Request $request){
        DB::beginTransaction();
        try {
            $payload = $this->formatPayload($request);
            // dd($payload);
            $license = $this->licenseRepository->create($payload);
            if ($license->id > 0) {
                //create notification
                $creator = $license->user?->name;
                $title = $creator .' tạo mới đơn xin';
                $data = ['id' => $license->id];
                $notification = [
                    'user_id'   => $license->approver,
                    'type'      => 'license',
                    'title'     => $title,
                    'data'      => $data,
                ];
                $this->notificationRepository->create($notification);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function getData(Request $request, $counter = false){
        $select = ['*'];
        $relations = ['user', 'type_term.languages', 'status_term.languages'];
        $condition = [];
        $payload = $request->input();

        // Điều kiện mặc định cho danh sách: nếu không filter ngày thì lấy đơn trong tháng hiện tại
        if (!empty($payload['start_date']) || !empty($payload['end_date'])) {
            // Người dùng có truyền ít nhất một ngày -> chuẩn hoá về định dạng Y-m-d
            if (!empty($payload['start_date'])) {
                $payload['start_date'] = Carbon::createFromFormat('d/m/Y', $payload['start_date'])->format('Y-m-d');
            }
            if (!empty($payload['end_date'])) {
                $payload['end_date'] = Carbon::createFromFormat('d/m/Y', $payload['end_date'])->format('Y-m-d');
            }
            // Nếu chỉ có 1 phía thì tự bù phía còn lại bằng ngày hiện tại
            if (empty($payload['start_date'])) {
                $payload['start_date'] = Carbon::now()->format('Y-m-d');
            }
            if (empty($payload['end_date'])) {
                $payload['end_date'] = Carbon::now()->format('Y-m-d');
            }
            $condition['whereBetween'] = [
                'start_date', [$payload['start_date'], $payload['end_date']]
            ];
        } else {
            // Không có filter ngày -> mặc định là từ đầu đến cuối tháng hiện tại
            $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
            $endOfMonth   = Carbon::now()->endOfMonth()->format('Y-m-d');
            $condition['whereBetween'] = [
                'start_date', [$startOfMonth, $endOfMonth]
            ];
        }
        if (isset($payload['id'])) {
            $condition['where'][] = [
                'id', '=', $payload['id']
            ];
        }
        if (isset($payload['license_status_term_id'])) {
            $condition['where'][] = [
                'license_status_term_id', '=', $payload['license_status_term_id']
            ];
        }
        if (isset($payload['perpage'])) {
            $condition['perPage'] = $payload['perpage'];
        }
        if (Gate::allows('modules', 'license.view.any')) {
            if (isset($payload['user_id'])) {
                $condition['where'][] = [
                    'user_id', '=', $payload['user_id']
                ];
            }
        }else if(Gate::allows('modules', 'license.view.own')) {
            $currentUser = Auth::user();
            $condition = [
                'where' => [
                    ['user_id', '=', $currentUser->id]
                ]
            ];
        }
		return $this->licenseRepository->getData(
            $select,
            $condition,
            $counter,
            [],
            '',
            [],
            $relations,
            
        );
	}
	private function formatPayload($request){
		$payload = $request->only($this->payload());
		$payload['start_date'] = Carbon::createFromFormat('d/m/Y', $payload['start_date']);
        if(isset($payload['end_date'])){
            $payload['end_date'] = Carbon::createFromFormat('d/m/Y', $payload['end_date']);
        }
		return $payload;
	}
	private function payload(){
        return [
            'user_id',
            'approver',
            'license_type_term_id',
            'license_status_term_id',
            'license_unit',
            'license_duration',
            'start_date',
            'end_date',
            'reason_leave'
        ];
    }
}