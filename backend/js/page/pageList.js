/* pageList.js
 * ============================
 * Page List module jquery code.
 *
 * @author  Krishna Prasad Timilsina
 * @email   <bikranshu.t@gmail.com>
 * @version 1.0
 */

var auction = auction || {};

;(function ($pageList, $common) {
    "use strict";

    var baseUrl = $common.getBaseUrl();

    $('#pages').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        paging: true,
        "ajax": {
            "url": baseUrl + "pages"
        },
        "aaSorting": [[3, "desc"]],
        "aoColumnDefs": [
            {'bSortable': false, 'aTargets': [0, 4]},
            {"sClass": "actions", "aTargets": [4]}
        ],
        columns: [
            {data: null, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'description', name: 'description'},
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

})(auction.pageList = auction.pageList || {}, auction.common);



