const mainTable = $("#main_table");
const modalUser = $("#modalUser");

mainTable.DataTable();

const edit = function(){
    modalUser.modal('show')
}

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
                    <td>
                        <button class="btn btn-warning" onclick="edit()">Edit</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            `);
        });

        mainTable.DataTable();
    },
});
