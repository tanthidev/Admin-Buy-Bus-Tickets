1. Cài đặt Docker Engine: https://www.docker.com/products/docker-desktop
2. Chạy và chờ cho đến khi Docker Engine khởi động thành công (có thể mất tới 1-2 phút với máy chậm)
3. Mở cửa sổ dòng lệnh (Terminal hoặc Command Prompt hoặc PowerShell)
4. Gõ lệnh "docker-compose up -d" và chờ nó chạy cho đến khi kết thúc (lần đầu tiên chạy có thể mất vài phút, cần mở internet)
5. Sau khi chạy thành công, try cập
	- http://localhost:8080 để kiểm tra website

Xử lý sự cố khi cần cài lại tự đầu 
 1. Di chuyển dòng lệnh đến thư mục gốc và gõ lệnh 'docker-compose down'
 2. Gõ 'docker images' để xem danh sách các docker images đang có 
 3. Gõ 'docker rmi <id của image>' để xóa hết các image.
 4. Gõ lệnh 'docker-compose up -d' để chạy lại từ đầu.
