import { PageAdminUsers } from "./page/admin/users";


/*** General setup START ***/
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
window.API = {};


API.pageManager = {};



/*** Init pages controllers ***/
API.pageManager.users = PageAdminUsers;