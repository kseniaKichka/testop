
<div class="container">
    <div class="row justify-content-start">
        <div class="col-4 offset-4">
            <form action="" enctype="multipart/form-data" method="post">
                <div class="form-group">
                    <label for="exampleFormControlInput1">User Name</label>
                    <input type="text" name="create[user_name]" onchange="document.getElementById('user_name_p').value = document.getElementById('user_name').value" class="form-control" id="user_name" placeholder="Enter user name">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Email address</label>
                    <input type="email" name="create[user_email]" onchange="document.getElementById('user_email_p').value = document.getElementById('user_email').value" class="form-control" id="user_email" placeholder="name@example.com">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Task Text</label>
                    <textarea class="form-control" onchange="document.getElementById('text_p').value = document.getElementById('text').value" name="create[text]" id="text" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Image</label>
                    <input type="file" name="image" class="form-control-file" id="image">
                </div>
                <input type="submit" class="btn btn-primary" name="create[submit]" value="Submit">
<!--                <input type="submit" class="btn btn-primary" name="create[preview]" value="Preview">-->
                <button type="button" class="btn btn-primary" data-toggle="modal" id="prev" data-target="#exampleModal">
                    Preview
                </button>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action=""  method="post">
                <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">User Name</label>
                            <input type="text" readonly name="create[user_name]" class="form-control" id="user_name_p" placeholder="Enter user name">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Email address</label>
                            <input type="email" readonly name="create[user_email]"  class="form-control" id="user_email_p" placeholder="name@example.com">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Task Text</label>
                            <textarea class="form-control" readonly name="create[text]" id="text_p" rows="3"></textarea>
                        </div>
                    <div class="form-group">
                        <input type="hidden" id="create_image" name="create[image]" value="">
                        <img id="rel_image" src="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" name="create[preview]" value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $("button#prev").click(function(event) {
            event.preventDefault();

            var file_data = $('#image').prop('files')[0];
            var formData = new FormData();
            formData.append('image', file_data);

            $.ajax({
                type: 'post',
                contentType: false,
                processData: false,
                url: window.location.href,
                data: formData,
                dataType: 'json',
                // response: 'text',
                success:function(data){
                    console.log(data);
                    $('#rel_image').attr('src', data);
                    $('#create_image').attr('value', data);

                }

            });
        });

    })

</script>