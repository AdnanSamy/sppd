const mainTable = $("#main_table");
const itemTable = $("#itemTable");
const modalDinas = $("#modalDinas");
const modalItem = $("#modalItem");
const btnNewItem = $("#btnNewItem");
const judul = $("#judul");
const save = $("#save");
const saveType = $("#saveType");
const btnNew = $("#btnNew");
const dataId = $("#dataId");
const SAVE_VALUE = 1;
const UPDATE_VALUE = 2;

const getAll = function () {
    $.ajax({
        url: "/api/dinas-travel",
        type: "get",
        success: function (res) {
            console.log("response get all -> ", res);
            const { data } = res;

            mainTable.DataTable().destroy();

            data.forEach((e, i) => {
                mainTable.find("tbody").append(`
                    <tr>
                        <td>${i + 1}</td>
                        <td>${e.judul}</td>
                        <td>${e.status}</td>
                        <td>${e.total}</td>
                        <td>
                            <button class="btn btn-warning" onclick="edit(${
                                e.id
                            })">Edit</button>
                            <button class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                `);
            });

            mainTable.DataTable();
        },
    });
};

const edit = function (id) {
    saveType.val(UPDATE_VALUE);
    dataId.val(id);
    $.ajax({
        url: `/api/dinas-travel/${id}`,
        type: "get",
        success: function (res) {
            const { data } = res;
            nameEl.val(data.name);
            email.val(data.email);
            role.val(data.role_id);

            modalDinas.modal("show");
        },
    });
};

const updateProcess = function () {
    $.ajax({
        url: "/api/dinas-travel",
        type: "put",
        data: {
            id: dataId.val(),
            name: nameEl.val(),
            email: email.val(),
            password: password.val(),
            role_id: role.val(),
        },
        success: function (res) {
            // console.log("RESPONSE UPDATE -> ", res);
            location.reload();
        },
        error: function (err) {
            alert("error");
            console.log("ERR -> ", err);
        },
    });
};

const saveProccess = function () {
    $.ajax({
        url: "/api/dinas-travel",
        type: "post",
        data: {
            name: nameEl.val(),
            email: email.val(),
            password: password.val(),
            role_id: role.val(),
        },
        success: function (res) {
            location.reload();
        },
        error: function (err) {
            alert("error");
            console.log("ERR -> ", err);
        },
    });
};

const getItemDinasTravels = function () {
    $.ajax({
        url: "/api/item-dinas-travel",
        type: "get",
        success: function (res) {
            console.log("ITEM DINAS TRAVEL -> ", res);
        },
        error: function (err) {
            alert("error");
            console.log("ERR -> ", err);
        },
    });
};

save.click(function () {
    if (saveType.val() == SAVE_VALUE) {
        saveProccess();
    } else if (saveType.val() == UPDATE_VALUE) {
        updateProcess();
    }
});

btnNew.click(function () {
    saveType.val(SAVE_VALUE);

    modalDinas.modal("show");
});

$(document).ready(function () {
    // getRoles();
    mainTable.DataTable({
        width: "100%",
    });
    itemTable.DataTable();
    getAll();
    getItemDinasTravels();
});
