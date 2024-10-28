<?php
//  header('Location: site-maintenance');
//  exit;
include('includes/access_header.php');
?>
<body>
   <div class="container">
        <div class="heading"><h2>District 404A2 Online Voting System</h2></div>
        <form action="initialize.php" method="POST">
            <div class="form">
                <h4>Get your voting code</h4>
                <label class="label"><sup class="req_symbol">*</sup>Lions ID:</label>
                <input type="text" name="lionsID" id="lionsID" class="input" placeholder=" Enter Lions ID" required>

                <label class="label"><sup class="req_symbol">*</sup>Full name:</label>
                <input type="text" name="fullname" id="fullname" class="input" placeholder="Enter full Name" required>

                <label class="label"><sup class="req_symbol">*</sup>Club:</label>
                <input type="text" name="club" id="club" class="input" placeholder="Your Club" required>

                <!--<label class="label"><sup class="req_symbol">*</sup>Phone Number:</label>-->
                <!--<input type="text" name="phone" id="phone" class="input" placeholder="Enter Phone Number" required>-->

                <label class="label"><sup class="req_symbol">*</sup>Email:</label>
                <input type="email" name="email" id="email" class="input" placeholder="Enter Email" required>
                
                <label class="label"><sup class="req_symbol">*</sup>Phone Number:</label>
                <input type="text" name="fone" id="fone" class="input" placeholder="Enter Phone Number" required>

                
                <button class="button" name="getcode">Get code</button>
                <div class="link1">Already have your code ? <a href="index.php">Proceed to vote</a></div>
            </div>
        </form>
   </div> 
   <p class="msg"></p>
  

</body>
</html>