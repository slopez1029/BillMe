<?php

session_start();
$payerID = $_SESSION['PayerID'];
echo"
      <aside>
          <div id='sidebar'  class='nav-collapse '>
              <ul class='sidebar-menu' id='nav-accordion'>
              
              	  <p class='centered'><a href='profile.html'><img src='assets/img/ui-sam.jpg' class='img-circle' width='60'></a></p>
              	  <h5 class='centered'>$payerID</h5>
              	  	
                  <li class='mt'>
                      <a class='active' href='index.html'>
                          <i class='fa fa-dashboard'></i>
                          <span>Dashboard</span>
                      </a>
                  </li>                  
                   <li class='sub-menu'>
                      <a href='javascript:;' >  
						<i class ='li_news'></i>
                          <span>Bills</span>
                      </a>
                      <ul class='sub'>
                          <li><a  href='Bills.html'>Group</a></li>
                          <li><a  href='UserBills.html'>Personal</a></li>
                      </ul>
                  </li>
				  <li class='sub-menu'>
                      <a href='group.html'>
                          <i class='li_heart'></i>
                          <span>Members</span>
                      </a>
                  </li>
				  <li class='sub-menu'>
                      <a href='history.html'>
                          <i class='fa fa-bar-chart-o'></i>
                          <span>History</span>
                      </a>
                  </li>
                 

              </ul>
          </div>
      </aside>
";
?>
