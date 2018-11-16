/* bidList.js
 * ===========================
 * Bid List module jquery code.
 *
 * @author  Krishna Prasad Timilsina
 * @email   <bikranshu.t@gmail.com>
 * @version 1.0
 */

var auction = auction || {};

;(function ($bidList, $common) {
    "use strict";

    var baseUrl = $common.getBaseUrl();

    $('#pending-bids').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        paging: true,
        "ajax": {
            "url": baseUrl + "bids"
        },
        "aaSorting": [[8, "desc"]],
        "aoColumnDefs": [
            {'bSortable': false, 'aTargets': [0, 9]},
            {"sClass": "actions", "aTargets": [9]}
        ],
        columns: [
            {data: null, searchable: false},
            {
                data: function (data) {
                    return (data.customer.first_name + ' ' + data.customer.last_name);
                }, name: 'name'
            },
            {
                data: function (data) {
                    return data.customer.address;
                }, name: 'address'
            },
            {
                data: function (data) {
                    return data.customer.phone;
                }, name: 'phone'
            },
            {data: 'bid_quantity', name: 'bid_quantity'},
            {data: 'bid_price', name: 'bid_price'},
            {data: 'total_price', name: 'total_price'},
            {
                data: function (data) {
                    switch (parseInt(data.status)) {
                        case 1:
                            return '<span class="badge badge-warning">Pending</span>';
                        case 2:
                            return '<span class="badge badge-success">Confirmed</span>';
                        case 3:
                            return '<span class="badge badge-danger">Cancelled</span>';
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

    $('#confirmed-bids').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        paging: true,
        "ajax": {
            "url": baseUrl + "bids/confirmed"
        },
        "aaSorting": [[9, "desc"]],
        "aoColumnDefs": [
            {'bSortable': false, 'aTargets': [0, 8]},
            {"sClass": "actions", "aTargets": [8]}
        ],
        columns: [
            {data: null, searchable: false},
            {
                data: function (data) {
                    return (data.customer.first_name + ' ' + data.customer.last_name);
                }, name: 'name'
            },
            {
                data: function (data) {
                    return data.customer.address;
                }, name: 'address'
            },
            {
                data: function (data) {
                    return data.customer.phone;
                }, name: 'phone'
            },
            {data: 'bid_quantity', name: 'bid_quantity'},
            {data: 'bid_price', name: 'bid_price'},
            {data: 'total_price', name: 'total_price'},
            {data: 'confirmed_date', name: 'confirmed_date'},
            {
                data: function (data) {
                    switch (parseInt(data.status)) {
                        case 1:
                            return '<span class="badge badge-warning">Pending</span>';
                        case 2:
                            return '<span class="badge badge-success">Confirmed</span>';
                        case 3:
                            return '<span class="badge badge-danger">Cancelled</span>';
                    }
                }, name: 'status'
            },
            {data: 'created_at', name: 'created_at'}
        ],
        "fnRowCallback": function (nRow, aData, iDisplayIndex) {
            var page = this.fnPagingInfo().iPage;
            var length = this.fnPagingInfo().iLength;
            var index = (page * length + (iDisplayIndex + 1));
            $('td:eq(0)', nRow).html(index);
        }
    });

})(auction.bidList = auction.bidList || {}, auction.common);



