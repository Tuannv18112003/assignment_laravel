
// delete cart 
    $(function() {
        $(document).on("click", "#delete", function(e) {
            e.preventDefault();
            var link = $(this).attr("href");

            Swal.fire({
                title: "Bạn có chắc?",
                text: "Xóa dữ liệu này?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Có, Xóa nó!",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                    Swal.fire("Deleted!", "Dữ liệu của bạn đã được xóa:)).", "success");
                }
            });
        });
    });