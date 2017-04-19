
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Project Registration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <form>

        <div class="form-group">
            <label for="usr">Name:</label>
            <input type="text" class="form-control" id="usr">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email">
        </div>

        <div class="form-group">
            <label for="sup">Supervisor:</label>
            <input type="text" class="form-control" id="sup">
        </div>

        <div class="form-group">
            <label for="dep">Department:</label>
            <input type="text" class="form-control" id="dep">
        </div>

        <div class="form-group">
            <label for="protopc">Project Topic:</label>
            <input type="text" class="form-control" id="protopc">
        </div>

        <div class="form-group">
            <label for="comment">Project Description</label>
            <textarea class="form-control" rows="5" id="comment"></textarea>
        </div>

        <div class="form-group">
            <label for="stadate">Start Date:</label>
            <input type="date" class="form-control" id="stadate">
        </div>

        <div class="form-group">
            <label for="enddate">Expected End Date:</label>
            <input type="date" class="form-control" id="enddate">
        </div>
        <div class="form-group">
            <h2>Does the research project involve any of the following risk factors:</h2>
            <div class="checkbox">
                <label><input type="checkbox" value="">Research involving health sector organisations</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" value="">Research involving children or other vulnerable groups</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" value="">Research involving sensitive topics</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" value="">Research involving aerospace/defence organisations</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" value="">Research involving nuclear production organisations</label>
            </div>
            <div class="form-group">
                <label for="comment">Details of the Data being Processed</label>
                <textarea class="form-control" rows="5" id="comment" placeholder="Please describe the details of the personal data that is being collected, including the methods of data collection and analysis."></textarea>
            </div>
            <div class="form-group">
                <label for="comment">Data Storage</label>
                <textarea class="form-control" rows="5" id="comment" placeholder="Please describe the arrangements you will make for the security of the data, including how and where it will be stored."></textarea>
            </div>
    </form>
</div>

</body>
</html>

