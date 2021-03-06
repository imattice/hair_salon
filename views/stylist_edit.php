<html>
    <head>
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
        <title>Edit this stylist</title>
    </head>
    <body>
        <div class="container">

        <h1>Update the {{ stylists.getName }} category </h1>

        <form action="/stylists/{{ stylists.getId }}" method="post">
            <input name="_method" type="hidden" value="patch">
                <div class="form-group">
                    <label for="name">Rename your stylist:</label>
                    <input id="name" name="name" type="text">
                </div>

          <button type="submit">Update!</button>
        </form>

        <form action="/stylists/{{ stylists.getId }}" method="post">
            <input name="_method" type="hidden" value="delete">

            <button type="submit">Delete this stylist</button>
        </form>
    </body>
</html>
