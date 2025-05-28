<form action="{{ route('reclam.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="url" name="href" placeholder="https://example.com" required>

    <select name="page" required>
        <option value="index">Գլխավոր էջ</option>
        <option value="news">Նորություններ</option>
        <option value="interview">Հարցազրույց</option>
        <option value="single">Բացված Նորություն</option>
    </select>

    <select name="position" required>
        <option value="top">Վերև</option>
        <option value="bottom">Ներքև</option>
        <option value="right_top">Աջ անկյուն վերև (բացված)</option>
        <option value="right_bottom">Աջ անկյուն ներքև (բացված)</option>
        <option value="bottom_large">Ներքև (բացված)</option>
    </select>

    <input type="file" name="img" accept="image/*" required>

    <button type="submit">Ավելացնել Գովազդ</button>
</form>
