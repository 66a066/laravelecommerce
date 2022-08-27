<!-- Modal
<div class="modal fade" id="StripeCardModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pay with Stripe</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class='form-row row'>
          <div class="col-md-12">
            <div>
              <p class="stripe-error py-3 text-danger"></p>
            </div>
          </div>
          <div class='col-xs-12 col-md-6 form-group required'>
            <label class="control-label">Name on Card</label>
            <input type="text" class="form-control" required size="4">
          </div>
          <div class='col-xs-12 col-md-6 form-group required'>
            <label class="control-label">Card Number</label>
            <input type="text" autocomplete='off' class="form-control card-number" required size="20">
          </div>
        </div>
        <div class='form-row row'>
          <div class='col-xs-12 col-md-6 form-group cvc required'>
            <label class='control-label'>CVC</label>
            <input type="text" autocomplete="off" class="form-control card-cvc" required placeholder="ex. 311" size="4">
          </div>
          <div class='col-xs-12 col-md-6 form-group expiration required'>
            <label class="control-label">Expiration Month</label>
            <input type="text" class="form-control card-expiry-month" required placeholder="MM" size="2">
          </div>
          <div class='col-xs-12 col-md-6 form-group expiration required'>
            <label class='control-label'>Expiration Year</label>
            <input type="text" class="form-control card-expiry-year" required placeholder="YYYY" size="4">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 form-group d-none">
            <div class="alert-danger alert">
              <h6 class="inp-error">Please correct the errors and try again.</h6>
            </div>
          </div>
        </div>
        <input type="hidden" name="stipe_payment_btn" value="1">
        <div class="row">
          <div class="col-md-12">
            <hr>
            <button type="submit" class="btn btn-primary btn-sm btn-block">Pay Now with Stripe</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> -->