<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login to iDiscuss</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/forum/partials/_handleLogin.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="Username">Username</label>
                        <input type="text" class="form-control" id="loginEmail" name="loginEmail" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" class="form-control" id="password" name="loginPass">
                    </div>
                    <button type="submit" class="btn btn-primary my-3">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>