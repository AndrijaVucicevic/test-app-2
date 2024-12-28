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
@if($currentRoute === 'users.edit')
<script>
    API.pageManager.userEdit.init()
</script>
@endif
@if($currentRoute === 'imports.create')
<script>
    API.pageManager.imports.init()
</script>
@endif
@if($currentRoute === 'orders.index')
<script>
    API.pageManager.orders.init()
</script>
@endif