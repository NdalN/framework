<style type="text/css">
.error-template {padding: 40px 15px;text-align: center; margin-top:50px;}
.error-actions {margin-top:15px;margin-bottom:15px;}
.error-actions .btn { margin-right:10px; }
h1{font-size:50px}
</style>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <h1>404 Not Found</h1>
                <?=$model->url?>
                <div class="error-details">
                    Sorry, an error has occured, Requested page not found!
                </div>
                <div class="error-actions">
                    <a href="/" class="btn btn-default" style="margin-top:5px"><span class="glyphicon glyphicon-home"></span> Take Me Home</a>
                    <a href="/" class="btn btn-default" style="margin-top:5px"><span class="glyphicon glyphicon-envelope"></span> Contact Support</a>
                </div>
            </div>
        </div>
    </div>
</div>
