    <div id="tampil_pdf"></div>
    

    <script>
        $('#tampil_pdf').html("<embed src='{{url('kasir/cetak?id='.$id)}}' type='application/pdf' width='100%' height='400px'/>");
    </script>
    