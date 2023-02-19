const mainTable = $("#main_table");
const itemTable = $("#itemTable");
const modalDinas = $("#modalDinas");
const modalReject = $("#modalReject");
const judul = $("#judul");
const saveType = $("#saveType");
const saveItem = $("#saveItem");
const dataId = $("#dataId");
const itemRequests = [];
const SAVE_VALUE = 1;
const UPDATE_VALUE = 2;
const note = $("#note");
const btnReject = $("#btnReject");
const rejectId = $("#rejectId");

function uuid() {
    return (
        Math.random().toString(36).substring(2, 15) +
        Math.random().toString(36).substring(2, 15)
    );
}

const actionReject = function (id) {
    rejectId.val(id);
    modalReject.modal("show");
};

const approve = function (id) {
    $.ajax({
        url: "/api/dinas-travel/approve",
        type: "put",
        data: {
            id,
        },
        success: function (res) {
            console.log("APPROVE RESPONSE -> ", res);
        },
        error: function (err) {
            alert("error");
            console.log("ERR -> ", err);
        },
    });
};

const reject = function () {
    $.ajax({
        url: "/api/dinas-travel/reject",
        type: "put",
        data: {
            id: rejectId.val(),
            note: note.val(),
        },
        success: function (res) {
            console.log("REJECT RESPONSE -> ", res);
        },
        error: function (err) {
            alert("error");
            console.log("ERR -> ", err);
        },
    });
};

const getAll = function () {
    $.ajax({
        url: "/api/dinas-travel/need-approval",
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
                            <button class="btn btn-warning" onclick="approve(${
                                e.id
                            })">Approve</button>
                            <button class="btn btn-danger" onclick="actionReject(${
                                e.id
                            })">Reject</button>
                        </td>
                    </tr>
                `);
            });

            mainTable.DataTable();
        },
    });
};

const clearItemRequest = function () {
    itemRequests.splice(0, itemRequests.length);
    generateItemRequest();
};

const edit = function (id) {
    saveType.val(UPDATE_VALUE);
    dataId.val(id);
    $.ajax({
        url: `/api/dinas-travel/${id}`,
        type: "get",
        success: function (res) {
            console.log("EDIT RESPONSE -> ", res);
            const { data } = res;
            const { item_request } = data;

            clearItemRequest();

            judul.val(data.judul);
            item_request.map((item) => {
                const { item_dinas_travel } = item;

                itemRequests.push({
                    id: uuid(),
                    item: item_dinas_travel.item,
                    item_dinas_travel_id: item_dinas_travel.id,
                    price: item.price,
                });
            });

            generateItemRequest();

            modalDinas.modal("show");
        },
    });
};

const getItemDinasTravels = function () {
    $.ajax({
        url: "/api/item-dinas-travel",
        type: "get",
        success: function (res) {
            console.log("ITEM DINAS TRAVEL -> ", res);
            const { data } = res;

            data.forEach((d) => {
                item.append(`
                    <option value="${d.id}">${d.item}</option>
                `);
            });
        },
        error: function (err) {
            alert("error");
            console.log("ERR -> ", err);
        },
    });
};

const generateItemRequest = function () {
    itemTable.DataTable().destroy();
    itemTable.find("tbody").html("");

    itemRequests.forEach((item, i) => {
        itemTable.find("tbody").append(`
            <tr>
                <td>${item.item}</td>
                <td>${item.price.toLocaleString()}</td>
                <td>
                    <button class="btn btn-danger" onclick="deleteItemRequest('${
                        item.id
                    }')">Delete</button>
                </td>
            </tr>
        `);
    });

    itemTable.DataTable({
        width: "100%",
    });
};

btnReject.click(function () {
    reject();
});

saveItem.click(function () {
    const optionSelected = item.find(":selected");
    itemRequests.push({
        id: uuid(),
        item: optionSelected.text(),
        item_dinas_travel_id: optionSelected.val(),
        price: price.val(),
    });

    generateItemRequest();
    modalItem.modal("hide");
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
