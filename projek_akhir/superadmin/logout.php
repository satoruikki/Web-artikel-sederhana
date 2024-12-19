<?php
session_start();
session_destroy(); 
header("Location: login.php"); 
echo "<script>
if (confirm('Apakah Anda yakin ingin logout?')) {
    alert('Anda berhasil logout!');
    window.location.href = 'logout.php';
} else {
    window.history.back();
}
</script>";
exit;
?>
