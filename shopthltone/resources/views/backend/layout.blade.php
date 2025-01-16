<!DOCTYPE html>
<html>

<head>
    @include('backend.component.head')

</head>

    <body>
        <div id="wrapper">
            @include('backend.component.sidebar')

            <div id="page-wrapper" class="gray-bg">
                @include('backend.component.nav')
                @include($template)
                @include('backend.component.footer')
            </div>
        </div>
        @include('backend.component.script')
    </body>
</html>
