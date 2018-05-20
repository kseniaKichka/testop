<div class="container">
    <div class="row justify-content-start">
        <div class="col-4 offset-4">
            <form action="" enctype="multipart/form-data" method="post">
                <div class="form-group">
                    <label for="exampleFormControlInput1">User Name</label>
                    <input type="text" name="create[user_name]" class="form-control" id="exampleFormControlInput1" placeholder="Enter user name">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Email address</label>
                    <input type="email" name="create[user_email]" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Task Text</label>
                    <textarea class="form-control" name="create[text]" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Image</label>
                    <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>