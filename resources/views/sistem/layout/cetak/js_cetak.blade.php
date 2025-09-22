    <script langauge="javascript">
    function keluar(){
        self.print();
        window.onafterprint = function(){
      alert("Dokumen Telah Dicetak...");
      self.close();
      }
    }

    keluar();
    </script>