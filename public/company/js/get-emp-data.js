export function getEmps(activeTabId) {
    let request = dictionaries[activeTabId];
    let response = null;
    if (request.data === null) {
        request.data = $(request.domElement).DataTable({
            columnDefs: [
                {
                    searchable: false,
                    orderable: false,
                    targets: 0,
                },
                {
                    searchable: false,
                    orderable: false,
                    className: "text-center",
                    targets: request.targets,
                },
            ],
            order: [[1, "asc"]],
            pageLength: 100,
            processing: true,
            DT_RowId: true,
            responsive: true,
            autoWidth: false,
            ajax: {
                url: request.url,
                dataSrc: "",
            },
            drawCallback: function (settings) {
                if (activeTabId === "ic-tab") {
                    response = settings.json;
                    if (response !== null && typeof response !== "undefined") {
                        let text = "";
                        response.forEach((element, index) => {
                            text +=
                                '<tr><td style="width: 3%;"><div class="form-check"><input class="form-check-input" type="checkbox" name="box' +
                                index +
                                '" id="inlineCheckbox' +
                                index +
                                ' " value="' +
                                element.id +
                                '"></div></td><td>' +
                                element.name +
                                "</td></tr>";
                        });
                        $("#batchFileTable").html(text);
                        if (response.length > 0)
                            $("#batchFileBtn").removeClass("d-none");
                    }
                }
            },
            rowId: "id",
            columns: request.columns,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json",
            },
        });
        request.data
            .on("order.dt search.dt", function () {
                request.data
                    .column(0, { search: "applied", order: "applied" })
                    .nodes()
                    .each(function (cell, i) {
                        cell.innerHTML = i + 1;
                    });
            })
            .draw();
    }
}
let commonColumns = [
    { data: null, name: "numb" },
    { data: "name", name: "name" },
    { data: "tc", name: "tc" },
    { data: "phone", name: "phone" },
    { data: "recruitment_date", name: "recruitment_date" },
    {
        data: "first_edu",
        name: "first_edu",
        render: function (data, type, row, meta) {
            return data === 1
                ? '<span><i class="fas fa-check mx-3" style="color: green"></i></span>'
                : '<span><i class="fas fa-times mx-3" style="color: red"></i></span>';
        },
    },
    {
        data: "second_edu",
        name: "second_edu",
        render: function (data, type, row, meta) {
            return data === 1
                ? '<span><i class="fas fa-check mx-3" style="color: green"></i></span>'
                : '<span><i class="fas fa-times mx-3" style="color: red"></i></span>';
        },
    },
    {
        data: "examination",
        name: "examination",
        render: function (data, type, row, meta) {
            return data === 1
                ? '<span><i class="fas fa-check mx-3" style="color: green"></i></span>'
                : '<span><i class="fas fa-times mx-3" style="color: red"></i></span>';
        },
    },
    {
        data: "id",
        render: function (data, type, row, meta) {
            return type === "display"
                ? '<button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteEmpModal" data-whatever="@getbootstrap"><i class="fas fa-trash"></i></button>'
                : data;
        },
    },
    {
        data: "id",
        render: function (data, type, row, meta) {
            return type === "display"
                ? '<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addEmpFile" data-whatever="@getbootstrap"><i class="fas fa-plus"></i></button>'
                : data;
        },
    },
    {
        data: "id",
        render: function (data, type, row, meta) {
            return type === "display"
                ? '<button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#addEmpIdentifyFile" data-whatever="@getbootstrap"><i class="fas fa-folder-plus"></i></button>'
                : data;
        },
    },
];
let dictionaries = {
    "ic-tab": {
        data: null,
        columns: commonColumns,
        domElement: "#allEmps",
        targets: [5, 6, 7, 8, 9, 10],
        url: "/get-company-employees-with-files/" + pathArray[3] + "/active",
    },
    "eec-tab": {
        data: null,
        columns: commonColumns,
        domElement: "#empsWithMissDocs",
        targets: [5, 6, 7, 8, 9, 10],
        url:
            "/get-company-employees-with-files/" +
            pathArray[3] +
            "/missing-docs",
    },
    "sc-tab": {
        data: null,
        columns: [
            { data: null, name: "numb" },
            { data: "name", name: "name" },
            { data: "position", name: "position" },
            { data: "tc", name: "tc" },
            { data: "phone", name: "phone" },
            {
                data: "deleted_at",
                render: function (data, type, row) {
                    let date = data
                        .toString()
                        .match(/([0-9]{4}-[0-9]{2}-[0-9]{2})T(.*)/);
                    return type === "export" ? data : date[1];
                },
                name: "deleted_at",
            },
            {
                data: "id",
                render: function (data, type, row, meta) {
                    return type === "display"
                        ? '<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#restoreEmpModal" data-whatever="@getbootstrap"><i class="fas fa-undo"></i></button>'
                        : data;
                },
            },
        ],
        domElement: "#deletedEmpTable",
        targets: [5, 6],
        url: "/get-company-employees-with-files/" + pathArray[3] + "/deleted",
    },
};
