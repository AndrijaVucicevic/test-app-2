import { PageAdminUsers } from "./page/admin/users";
import { PageAdminPermissions } from "./page/admin/permissions";
import { ImportLogService, PermissionService } from "./app/service";
import { PageAdminEditUser } from "./page/admin/users/edit";
import { PageImports } from "./page/imports";
import { PageOrders } from "./page/admin/orders";
import { PageImportLogs } from "./page/imports/main";
/*** General setup START ***/
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
window.API = {};
API.service = {
    permission: PermissionService,
    importLog: ImportLogService
};

API.pageManager = {};



/*** Init pages controllers ***/
API.pageManager.users = PageAdminUsers;
API.pageManager.permissions = PageAdminPermissions;
API.pageManager.userEdit = PageAdminEditUser;
API.pageManager.imports = PageImports;
API.pageManager.orders = PageOrders;
API.pageManager.importLog = PageImportLogs;