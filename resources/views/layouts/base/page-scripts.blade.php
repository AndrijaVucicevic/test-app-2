@if($currentRoute === 'users.index')
    <script>
        API.pageManager.users.init()
    </script>
@endif
@if($currentRoute === 'permissions.index')
    <script>
        API.pageManager.permissions.init()
    </script>
@endif