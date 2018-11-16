<!-- Modal -->
<div class="modal fade" id="bidStatusModal" tabindex="-1" role="dialog" aria-labelledby="bidStatusModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! Form::open(['class' => 'form-horizontal','id' => 'bid-status-form', 'role' => 'form', 'method' => 'POST']) !!}
            {!! Form::hidden('id', null , array('id' => 'id')) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="bidStatusModalLabel">Approved Bid</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="reason" class="col-form-label">Reason</label>
                    <textarea placeholder="Reason" class="form-control" name="reason" cols="40"
                              rows="3"></textarea>
                </div>
                <div class="form-group row">
                    <legend class="col-form-label col-sm-2 pt-0">Status</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input flat-red" type="radio" name="status" id="confirmed"
                                   value="2" checked>
                            <label class="form-check-label" for="confirmed">
                                Confirmed
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input flat-red" type="radio" name="status" id="cancel"
                                   value="3">
                            <label class="form-check-label" for="cancel">
                                Cancel
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">&nbsp;No</button>
                <button type="submit" class="save-yes-btn btn btn-info">&nbsp;Save</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>