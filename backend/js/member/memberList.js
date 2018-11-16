/* memberList.js
 * =============================
 * Member List module jquery code.
 *
 * @author  Krishna Prasad Timilsina
 * @email   <bikranshu.t@gmail.com>
 * @version 1.0
 */

var auction = auction || {};

;(function ($memberList, $common) {
    "use strict";

    var baseUrl = $common.getBaseUrl();

    $('#members').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        paging: true,
        "ajax": {
            "url": baseUrl + "members"
        },
        "aaSorting": [[2, "desc"]],
        "aoColumnDefs": [
            {'bSortable': false, 'aTargets': [0, 3]},
            {"sClass": "actions", "aTargets": [3]}
        ],
        columns: [
            {data: null, searchable: false},
            {data: 'name', name: 'name'},
            {
                data: function (data) {
                    switch (parseInt(data.status)) {
                        case 0:
                            return '<span class="badge badge-danger">Inactive</span>';
                        case 1:
                            return '<span class="badge badge-success">Active</span>';
                    }
                }, name: 'status'
            },
            // {data: 'photo', name: 'photo'},
            {data: 'created_at', name: 'created_at'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false}
        ],
        "fnRowCallback": function (nRow, aData, iDisplayIndex) {
            var page = this.fnPagingInfo().iPage;
            var length = this.fnPagingInfo().iLength;
            var index = (page * length + (iDisplayIndex + 1));
            $('td:eq(0)', nRow).html(index);
        }
    });

})(auction.memberList = auction.memberList || {}, auction.common);



