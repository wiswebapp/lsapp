<script>
    function removeAdmin(adminId){
        if(confirm('Are you sure you want to delete ?')){
            $.ajax({
                type : "POST",
                url : '{{url('admin/adminuser/delete/')}}',
                data : {
                    "_token": "{{ csrf_token() }}",
                    adminId:adminId
                },
                success : function(response) {
                    location.reload();
                }
            });
        }
    }
</script>