/* productList.js
 * ===============================
 * Product List module jquery code.
 *
 * @author  Krishna Prasad Timilsina
 * @email   <bikranshu.t@gmail.com>
 * @version 1.0
 */

var auction = auction || {};

;(function ($productList, $common) {
    "use strict";

    var baseUrl = $common.getBaseUrl();

    $('#products').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        paging: true,
        "ajax": {
            "url": baseUrl + "products"
        },
        "aaSorting": [[8, "desc"]],
        "aoColumnDefs": [
            {'bSortable': false, 'aTargets': [0, 9]},
            {"sClass": "actions", "aTargets": [9]}
        ],
        columns: [
            {data: null, searchable: false},
            {data: 'name', name: 'name'},
            {
                data: function (data) {
                    return data.item.name ;
                }, name: 'name'
            },
            {data: 'delivery_date', name: 'delivery_date'},
            {data: 'closed_date', name: 'closed_date'},
            {data: 'offer_quantity', name: 'offer_quantity'},
            {data: 'min_reserved_price', name: 'min_reserved_price'},
            {
                data: function (data) {
                    switch (parseInt(data.status)) {
                        case 0:
                            return '<span class="badge badge-warning">Inactive</span>';
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

})(auction.productList = auction.productList || {}, auction.common);



