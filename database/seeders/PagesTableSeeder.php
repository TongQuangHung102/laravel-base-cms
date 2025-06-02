<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Xóa tất cả các bản ghi cũ trước khi thêm mới để tránh trùng lặp khi chạy lại seeder
        Page::truncate();

        // Thêm các bản ghi Page
        Page::create([
            'title' => 'Giới thiệu về chúng tôi',
            'content' => '<p>Đây là trang giới thiệu về công ty chúng tôi. Chúng tôi chuyên cung cấp các giải pháp công nghệ tiên tiến.</p>
                          <p>Với nhiều năm kinh nghiệm, chúng tôi tự hào mang đến những sản phẩm và dịch vụ chất lượng cao nhất.</p>',
            'thumbnail' => 'thumbnails/1.jpg',
        ]);

        Page::create([
            'title' => 'Chính sách bảo mật',
            'content' => '<p>Chính sách bảo mật của chúng tôi mô tả cách chúng tôi thu thập, sử dụng và bảo vệ thông tin cá nhân của bạn.</p>
                          <p>Vui lòng đọc kỹ để hiểu rõ quyền lợi của bạn.</p>',
            'thumbnail' => null,
        ]);

        Page::create([
            'title' => 'Điều khoản sử dụng',
            'content' => '<p>Chào mừng bạn đến với website của chúng tôi. Vui lòng đọc kỹ các điều khoản và điều kiện sử dụng dịch vụ.</p>
                          <p>Bằng cách truy cập và sử dụng website này, bạn đồng ý tuân thủ các điều khoản này.</p>',
            'thumbnail' => null,
        ]);

        Page::create([
            'title' => 'Câu hỏi thường gặp (FAQ)',
            'content' => '<p>Dưới đây là một số câu hỏi thường gặp về dịch vụ của chúng tôi. Nếu bạn có thêm câu hỏi, đừng ngần ngại liên hệ với chúng tôi.</p>',
            'thumbnail' => null,
        ]);
    }
}
