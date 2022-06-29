<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class='attribute' >
    <table id='contacts'>
     <caption>Contact List</caption>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Mobile</th>
          <th>Company</th>
          <th>Title</th>
          
        </tr>
        
        <?php foreach ($items as $item): ?>
          <tr>  
            <td>
            <?php echo $item->id .'</br>'; ?>
            </td>

            <td>
            <?php echo $item->name .'</br>'; ?>
            </td>

            <td>
            <?php echo $item->email .'</br>'; ?>
            </td>

            <td>
            <?php echo $item->mobile .'</br>'; ?>
            </td>

            <td>
            <?php echo $item->company .'</br>'; ?>
            </td>

            <td>
            <?php echo $item->title .'</br>'; ?>
            </td>

        </tr>
                   
        <?php endforeach; ?>

               
        
</table>
</div>
</body>
</html>