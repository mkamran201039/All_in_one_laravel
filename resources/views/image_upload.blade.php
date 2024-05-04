<!-- image_upload.blade.php -->
<form action="/upload" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="profile_picture">
    <button type="submit">Upload</button>
</form>




@if(isset($profilePicture))
    <img src="{{ '/storage/' . $profilePicture }}" alt="Profile Picture" height="200px" width="200px">
@endif




