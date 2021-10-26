        <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php?page=home"><i class="fa fa-fw fa-dashboard" aria-hidden="true"></i> Dashboard</a>
                    </li>
                    <?php if ($_SESSION['ROLE'] == 100): ?>
                    <li class=''>
                        <a href="index.php?page=user&&active=1"><i class="fa fa-users" aria-hidden="true"></i> Users</a>
                    </li>
                    <li class=''>
                        <a href="index.php?page=account"><i class="fa fa-user" aria-hidden="true"></i> Accounts</a>
                    </li>
                    <li class=''>
                        <a href="index.php?page=payment"><i class="fa fa-paypal" aria-hidden="true"></i> Payments</a>
                    </li>
                    <?php endif; ?>
                    <li class=''>
                        <a href="index.php?page=transaction"><i class="fa fa-money" aria-hidden="true"></i> Transactions</a>
                    </li>
                    <li class=''>
                        <a href="index.php?page=task"><i class="fa fa-list" aria-hidden="true"></i> Tasks</a>
                    </li>
                    <li class=''>
                        <a href="index.php?page=bid"><i class="fa fa-check" aria-hidden="true"></i> Bids</a>
                    </li>
                   
    </ul>
<script>
    var _h = location.href;

        $('.side-nav a').each(function(){
            var url = $(this).attr("href");
            var inc = url.split('&')[0];
            if(_h.includes(inc) == true){
                $(this).closest('li').addClass('active')
            }
        })
</script>