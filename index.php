<?php session_start();

	
	
	$link=mysql_connect("localhost","root","")
	or die("Can't Connect...");
	mysql_select_db("shop",$link) 
	or die("Can't Connect to Database...");

	
	$site_id=$_GET['id'];
	
	//Query
	$query="select *from book ORDER BY b_id DESC LIMIT 8";
	
	// $query="select *from book ORDER BY b_id=site_id DESC LIMIT 8";

	$res=mysql_query($query,$link) 
			or die("Can't Execute Query..");
	$row=mysql_fetch_assoc($res);
	

	
	
	#$cat=$_GET['subcatid'];
	
	//Query
	$totalq="select count(*) \"total\" from book";
	$totalres=mysql_query($totalq,$link) 
		or die("Can't Execute Query...");
	$totalrow=mysql_fetch_assoc($totalres);
	
	
	$page_per_page=6;
	$page_total_rec=$totalrow['total'];
	$page_total_page=ceil($page_total_rec/$page_per_page);
	
	
	if(!isset($_GET['page']))
	{
		$page_current_page=1;
	}
	else
	{
		$page_current_page=$_GET['page'];
	}

	$site_count=$row['b_count'];
	$site_count++;
	
	//Query
	// SITE COUNT
	$site_count_query="UPDATE book set b_count=$site_count where b_id=$site_id";
	mysql_query($site_count_query,$link) 
		or die("Can't Execute Query..");
		
		// mysql_fetch_assoc($site_count_query);
?>



<!DOCTYPE html>
<html>
<head>
		<?php
			include("includes/head.inc.php");
		?>
		
</head>

<body>

			<!-- start header -->
				<div id="header">
					<div id="menu">
						<?php
							include("includes/menu.inc.php");
						?>
							'<h1>
								<font color="red">SITE COUNT :' 
							
							
							<?php 
								echo $site_count ; 
							?>
							'</font>
							</h1>' 		
					</div>
				</div>
				
				<div id="logo-wrap">
					<div id="logo">
							<?php
								include("includes/logo.inc.php");
							?>
					</div>
				</div>
			<!-- end header -->
			
			<!-- start page -->
				<div id="page">
					<!-- start content -->
					<div id="content">
						<div class="post">
							<h1 class="title">Welcome <? echo $['unm']; ?>
							<?php 
								if(isset($_SESSION['status']))
								{
									echo $_SESSION['unm']; 
								}
								else
								{	
									echo 'Book Shop';
								}
							?>
							</h1>
							<div class="entry">
								<br>
								<p>
								</p>
							
							<div id="content">
								<div class="post">
									<h1 class="title">RECENTLY ADDED BOOKS</h1>
									<div class="entry">
										
										<table border="10" width="100%" >
											
											<?php
												
												$k=($page_current_page-1)*$page_per_page;
											
												$query="select *from book ORDER BY b_id DESC LIMIT 8";
	
												$res=mysql_query($query,$link) or die("Can't Execute Query...");
	
												$count=0; //count set
												while($row=mysql_fetch_assoc($res))
												{
													if($count==0)
													{
														echo '<tr>';
													}	
													echo '<td valign="top" width="20%" align="center">
													
													<a href="detail.php?id='.$row['b_id'].'&cat=">
													
													<img src="'.$row['b_img'].'" width="80" height="100">
													
													<br>'.$row['b_nm'].'</a>
													
													</td>';
													
													
													$count++;	//count incremented						
													
													if($count==2)
													{
														echo '</tr>';
														$count=0;
													}
												}
											?>
											
										</table>
										<br><br><br>
									</div>
								</div>
							</div>
							
							
							
							<div id="content">
								<div class="post">
									<h1 class="title">MOST VISITED BOOKS</h1>
									<div class="entry">
										
										<table border="10" width="100%" >
											
											<?php
												
												$k=($page_current_page-1)*$page_per_page;
											
												$query="select *from book ORDER BY b_visit DESC ";
												
												// UPDATE book SET	book.b_id=click_count.id FROM book INNER JOIN click_count ON  book.b_id = click_count.id
	
												$res=mysql_query($query,$link) or die("Can't Execute Query...");
	
												$count=0; //count set
												while($row=mysql_fetch_assoc($res))
												{
													if($count==0)
													{
														echo '<tr>';
													}	
													echo '<td valign="top" width="20%" align="center">
													
													<a href="detail.php?id='.$row['b_id'].'&cat=">
													
													<img src="'.$row['b_img'].'" width="80" height="100">
													
													<br>'.$row['b_nm'].'</a>
													
													</td>';
													
													
													$count++;	//count incremented						
													
													if($count==2)
													{
														echo '</tr>';
														$count=0;
														//break;
													}
												}
											?>
											
										</table>
										<br><br><br>
									</div>
								</div>
							</div>
							</div>
						</div>
					</div>
					<!-- end content -->
					
					<!-- start sidebar -->
					<div id="sidebar">
							<?php
								include("includes/search.inc.php");
							?>
					</div>
					<!-- end sidebar -->
					<div style="clear: both;">&nbsp;</div>
				</div>
			<!-- end page -->
			
			<!-- start footer -->
				<div id="footer">
							<?php
							//	include("includes/footer.inc.php");
							?>
				</div>
			<!-- end footer -->
</body>
</html>







