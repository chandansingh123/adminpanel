/* galleryList.js
 * =============================
 * Gallery List module jquery code.
 *
 * @author  Krishna Prasad Timilsina
 * @email   <bikranshu.t@gmail.com>
 * @version 1.0
 */

var auction = auction || {};

;(function ($galleryList, $common) {
    "use strict";

    var baseUrl = $common.getBaseUrl();

    $('#galleries').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        paging: true,
        "ajax": {
            "url": baseUrl + "galleries"
        },
        "aaSorting": [[4, "desc"]],
        "aoColumnDefs": [
            {'bSortable': false, 'aTargets': [0, 5]},
            {"sClass": "actions", "aTargets": [5]}
        ],
        columns: [
            {data: null, searchable: false},
            {data: 'title', name: 'title'},
            {data: 'description', name: 'description'},
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

})(auction.galleryList = auction.galleryList || {}, auction.common);



