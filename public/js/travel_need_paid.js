const mainTable = $("#main_table");
const itemTable = $("#itemTable");
const modalDinas = $("#modalDinas");
const modalPay = $("#modalPay");
const judul = $("#judul");
const saveType = $("#saveType");
const saveItem = $("#saveItem");
const dataId = $("#dataId");
const itemRequests = [];
const SAVE_VALUE = 1;
const UPDATE_VALUE = 2;
const buktiPembayaran = $("#buktiPembayaran");
const btnPay = $("#btnPay");

function uuid() {
    return (
        Math.random().toString(36).substring(2, 15) +
        Math.random().toString(36).substring(2, 15)
    );
}

const actionPay = function (id) {
    dataId.val(id);
    modalPay.modal("show");
};

const pay = function () {
    const fd = new FormData();
    fd.append("id", dataId.val());
    fd.append("bukti_pembayaran", buktiPembayaran[0].files[0]);

    $.ajax({
        url: "/api/dinas-travel/upload-bukti",
        type: "post",
        data: fd,
        processData: false,
        contentType: false,
        success: function (res) {
            location.reload();
            console.log(res);
        },
        error: function (res) {
            console.log(res);
        },
    });
};

const getAll = function () {
    $.ajax({
        url: "/api/dinas-travel/need-paid",
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
                        <td>${e.request_user_id.no_rek}</td>
                        <td>${e.request_user_id.bank}</td>
                        <td>
                            <button class="btn btn-warning" onclick="actionPay(${
                                e.id
                            })">Pay</button>
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

btnPay.click(function () {
    pay();
});

$(document).ready(function () {
    // getRoles();
    mainTable.DataTable({
        width: "100%",
    });
    getAll();
});
