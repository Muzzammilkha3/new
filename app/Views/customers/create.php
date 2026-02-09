<h3>Add Customer</h3>
<form method="post" action="/?route=customers_store">
    <div class="row">
        <div class="col-md-6 mb-3"><label class="form-label">Name</label><input name="name" class="form-control" required></div>
        <div class="col-md-6 mb-3"><label class="form-label">Phone</label><input name="phone" class="form-control"></div>
        <div class="col-md-6 mb-3"><label class="form-label">Email</label><input name="email" type="email" class="form-control"></div>
        <div class="col-md-6 mb-3"><label class="form-label">Address</label><input name="address" class="form-control"></div>
    </div>
    <button class="btn btn-primary">Save</button>
</form>
