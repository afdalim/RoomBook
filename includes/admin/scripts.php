<script src="/roombook/assets/adminlte/plugins/jquery/jquery.min.js"></script>

<script src="/roombook/assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="/roombook/assets/adminlte/dist/js/adminlte.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</div>

</body>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>

<script>

$(function(){

$('.datatable').DataTable({

responsive:true,

autoWidth:false,

pageLength:10,

language:{

search:"🔍 Cari :",

lengthMenu:"Tampilkan _MENU_ data",

zeroRecords:"Data tidak ditemukan",

info:"Menampilkan _START_ sampai _END_ dari _TOTAL_ data",

paginate:{

previous:"←",

next:"→"

}

}

});

});

</script>
</html>