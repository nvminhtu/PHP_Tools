<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tools lấy hình theo 1 URL nhất định</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="container bs-docs-container">
	<div class="bs-docs-header">
		<h1>Tool download hình ảnh</h1>
		<h2>Pattern 1: chỉ lấy 1 link và lưu vào 1 folder nhất định</h2>
	</div>
	<div class="row">
		<div class="col-md-8">
			<form name="getURL01" method="post" action="get_images.php">
				<div class="form-group">
			    <label for="web_url">Nhập URL:</label>
			    <input type="text" class="form-control" name="web_url" placeholder="URL của 1 chapter truyện tranh nào đó">
			  </div>
			   <div class="form-group">
			    <label for="web_div">Nhập class của div - khu vực muốn lấy (VD: read-content)</label>
			    <input type="text" class="form-control" name="web_div" placeholder="tên div class">
			  </div>
			  <div class="form-group">
			    <label for="web_attribute">Nhập attribute để get hình</label>
			    <input type="text" class="form-control" name="web_attribute" placeholder="Nhập attribute của riêng site đó nếu có">
			  </div>
			  <div class="form-group">
			    <label for="web_local">Nhập vào đường dẫn thư mục trên máy</label>
			    <input type="text" class="form-control" name="web_local" placeholder="Nhập vào đường dẫn thư mục trên máy">
			  </div>
			  <button type="submit" class="btn btn-default">Submit</button>
			</form>
		</div>
	</div>
</div>
</body>
</html>