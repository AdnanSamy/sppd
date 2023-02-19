// ESSENTIAL VAR
const mainTable = $("#main_table");
const save = $("#save");
const saveType = $("#saveType");
const btnNew = $("#btnNew");
const dataId = $("#dataId");
const SAVE_VALUE = 1;
const UPDATE_VALUE = 2;

// SPESIFIK
const modalItemDinasTravel = $("#modalItemDinasTravel");
const item = $("#item");

const getAll = function () {
    $.ajax({
        url: "/api/item-dinas-travel",
        type: "get",
        success: function (res) {
            console.log("response get all -> ", res);
            const { data } = res;

            mainTable.DataTable().destroy();

            data.forEach((e, i) => {
                mainTable.find("tbody").append(`
                    <tr>
                        <td>${i + 1}</td>
                        <td>${e.item}</td>
                        <td>
                            <button class="btn btn-warning" onclick="edit(${
                                e.id
                            })">Edit</button>
                            <button class="btn btn-danger" onclick="deleteData(${
                                e.id
                            })">Delete</button>
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
        url: `/api/item-dinas-travel/${id}`,
        type: "get",
        success: function (res) {
            const { data } = res;
            item.val(data.item);

            modalItemDinasTravel.modal("show");
        },
    });
};

const updateProcess = function () {
    $.ajax({
        url: "/api/item-dinas-travel",
        type: "put",
        data: {
            id: dataId.val(),
            item: item.val(),
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
        url: "/api/item-dinas-travel",
        type: "post",
        data: {
            item: item.val(),
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

const deleteData = function (id) {
    $.ajax({
        url: `/api/item-dinas-travel/${id}`,
        type: "delete",
        success: function (res) {
            console.log('DEL RESPONSE -> ', res);
            location.reload();
        },
        error: function (err) {
            alert("error");
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

    modalItemDinasTravel.modal("show");
});

$(document).ready(function () {
    getAll();
});
