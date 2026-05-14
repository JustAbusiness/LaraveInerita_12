const CustomNotice = () => {
    return (
        <div className="space-y-4">
            <h2 className="text-[18px] font-bold uppercase text-zinc-900 tracking-tight">
                Chú Ý
            </h2>
            <div className="space-y-2 text-sm text-zinc-500 font-medium">
                <p>Nhập đầy đủ các thông tin chi tiết để quản lý dữ liệu thành viên một cách chính xác nhất.</p>
                <p>
                    Lưu ý: các trường đánh dấu{' '}
                    <span className="text-rose-500 font-bold">(*)</span> là bắt buộc.
                </p>
            </div>
        </div>
    );
};

export default CustomNotice;
