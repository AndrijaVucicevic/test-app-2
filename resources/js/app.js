import { PageAdminUsers } from "./page/admin/users";
import { PageAdminPermissions } from "./page/admin/permissions";
import { PermissionService } from "./app/service";
import { PageAdminEditUser } from "./page/admin/users/edit";
import { PageImports } from "./page/imports";
import { PageOrders } from "./page/admin/orders";
/*** General setup START ***/
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
window.API = {};
API.service = {
    permission: PermissionService,
};

API.pageManager = {};



/*** Init pages controllers ***/
API.pageManager.users = PageAdminUsers;
API.pageManager.permissions = PageAdminPermissions;
API.pageManager.userEdit = PageAdminEditUser;
API.pageManager.imports = PageImports;
API.pageManager.orders = PageOrders;