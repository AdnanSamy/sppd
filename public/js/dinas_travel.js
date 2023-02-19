const mainTable = $("#main_table");
const itemTable = $("#itemTable");
const modalDinas = $("#modalDinas");
const modalItem = $("#modalItem");
const btnNewItem = $("#btnNewItem");
const judul = $("#judul");
const save = $("#save");
const saveType = $("#saveType");
const saveItem = $("#saveItem");
const btnNew = $("#btnNew");
const dataId = $("#dataId");
const item = $("#item");
const price = $("#price");
const itemRequests = [];
const SAVE_VALUE = 1;
const UPDATE_VALUE = 2;
const note = $("#note");
const total = $("#total");
const modalBuktiTransfer = $("#modalBuktiTransfer");
const buktiTransfer = $("#buktiTransfer");

function uuid() {
    return (
        Math.random().toString(36).substring(2, 15) +
        Math.random().toString(36).substring(2, 15)
    );
}

const getAll = function () {
    $.ajax({
        url: "/api/dinas-travel",
        type: "get",
        success: function (res) {
            console.log("response get all -> ", res);
            const { data } = res;

            mainTable.DataTable().destroy();

            data.forEach((e, i) => {
                let html = `
                    <tr>
                        <td>${i + 1}</td>
                        <td>${e.judul}</td>
                        <td>${e.status}</td>
                        <td>${e.total}</td>
                        <td>
                            <button class="btn btn-warning" onclick="edit(${
                                e.id
                            })">Edit</button>
                            <button class="btn btn-danger" onclick="deleteData(${
                                e.id
                            })">Delete</button>

                `;

                if (e.bukti_transfer != null) {
                    html += `
                        <button class="btn btn-success m-1" onclick="getBuktiTransfer(${e.id})">Bukti Pembayaran</button>
                    `;
                }

                html += `
                        </td>
                    </tr>
                `;
                mainTable.find("tbody").append(html);
            });

            mainTable.DataTable();
        },
    });
};

const clearItemRequest = function () {
    itemRequests.splice(0, itemRequests.length);
    generateItemRequest();
};

const deleteData = function (id) {
    $.ajax({
        url: `/api/dinas-travel/${id}`,
        type: "delete",
        success: function (res) {
            location.reload();
        },
    });
};

const getBuktiTransfer = function (id) {
    buktiTransfer.attr("src", `/api-dinas-travel/bukti-transfer/${id}`);
    modalBuktiTransfer.modal("show");
    // $.ajax({
    //     url: `/api-dinas-travel/bukti-transfer/${id}`,
    //     type: "get",
    //     success: function (res) {
    //         console.log("RESPONSE BUKTI TRANSFER -> ", res);
    //         const url = "data:image/jpg;base64," + btoa(res);
    //     },
    // });
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
            note.val(data.note);
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

const updateProcess = function () {
    $.ajax({
        url: "/api/dinas-travel",
        type: "put",
        data: {
            id: dataId.val(),
            judul: judul.val(),
            total: total.val(),
            itemRequest: itemRequests,
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
            judul: judul.val(),
            total: total.val(),
            itemRequest: itemRequests,
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

const deleteItemRequest = function (id) {
    const itemRequest = itemRequests.findIndex((e) => e.id == id);

    console.log("INDEX ITEM -> ", itemRequest);

    if (itemRequest != -1) {
        itemRequests.splice(itemRequest, 1);
    }

    generateItemRequest();
};

const generateItemRequest = function () {
    itemTable.DataTable().destroy();
    itemTable.find("tbody").html("");

    let totalPrice = 0;

    itemRequests.forEach((item, i) => {
        totalPrice += item.price;

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

    total.val(totalPrice);

    itemTable.DataTable({
        width: "100%",
    });
};

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

save.click(function () {
    if (saveType.val() == SAVE_VALUE) {
        saveProccess();
    } else if (saveType.val() == UPDATE_VALUE) {
        updateProcess();
    }
});

btnNewItem.click(function () {
    modalItem.modal("show");
});

btnNew.click(function () {
    clearItemRequest();
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
