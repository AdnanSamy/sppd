const mainTable = $("#main_table");
const modalUser = $("#modalUser");
const nameEl = $("#name");
const email = $("#email");
const password = $("#password");
const role = $("#role");
const save = $("#save");
const saveType = $("#saveType");
const btnNew = $("#btnNew");
const dataId = $("#dataId");
const SAVE_VALUE = 1;
const UPDATE_VALUE = 2;

mainTable.DataTable();

const edit = function (id) {
    saveType.val(UPDATE_VALUE);
    dataId.val(id);
    $.ajax({
        url: `/api/user/${id}`,
        type: "get",
        success: function (res) {
            const { data } = res;
            nameEl.val(data.name);
            email.val(data.email);
            role.val(data.role_id);

            modalUser.modal("show");
        },
    });
};

const updateProcess = function () {
    $.ajax({
        url: "/api/user",
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
        url: "/api/user",
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

const getRoles = function () {
    $.ajax({
        url: "/api/role",
        type: "get",
        success: function (res) {
            const { data } = res;
            data.forEach((d) => {
                role.append(`
                    <option value="${d.id}">${d.name}</option>
                `);
            });
        },
    });
};

$.ajax({
    url: "/api/user",
    type: "get",
    success: function (res) {
        console.log("response get all -> ", res);
        const { data } = res;

        mainTable.DataTable().destroy();

        data.forEach((e, i) => {
            mainTable.find("tbody").append(`
                <tr>
                    <td>${i + 1}</td>
                    <td>${e.name}</td>
                    <td>${e.email}</td>
                    <td>${e.role.name}</td>
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

save.click(function () {
    if (saveType.val() == SAVE_VALUE) {
        saveProccess();
    } else if (saveType.val() == UPDATE_VALUE) {
        updateProcess();
    }
});

btnNew.click(function () {
    saveType.val(SAVE_VALUE);

    modalUser.modal("show");
});

$(document).ready(function () {
    getRoles();
});
