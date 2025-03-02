CREATE TABLE `MON_AN` (
  `id` char(12) PRIMARY KEY NOT NULL ,
  `name` nvarchar(50) UNIQUE NOT NULL COMMENT 'Tên món ăn',
  `countSale` int(8) DEFAULT 0 COMMENT 'Số lượng bán',
  `type` bool NOT NULL COMMENT 'Loại món ăn',
  `isDelete` bool DEFAULT 0 COMMENT 'Delete',
  `id_cate` char(7) COMMENT 'Nhóm Món',
  `id_cus` char(9) COMMENT 'Nhóm topping tự chọn',
  `des` nvarchar(200) COMMENT 'Mô tả món ăn',
  `img` varchar(200) COMMENT 'Link ảnh'
);

CREATE TABLE `CUSTOMIZATION` (
  `id` char(9) PRIMARY KEY NOT NULL ,
  `name` nvarchar(50),
  `isDelete` bool DEFAULT 0 COMMENT 'Delete'
);

CREATE TABLE `CUS_GROUP` (
  `id` char(9) PRIMARY KEY,
  `name` nvarchar(50),
  `id_cus` char(10) COMMENT 'Mã Tùy Chỉnh',
  `isDelete` bool DEFAULT 0 COMMENT 'Delete',
  `min` int(2) NOT NULL COMMENT 'Số lượng tối thiểu được chọn',
  `max` int(2) NOT NULL COMMENT 'Số lượng tối đa được chọn'
);

CREATE TABLE `CUS_GROUP_TOPPING` (
  `id_group` char(9),
  `id_topping` char(12),
  `isDelete` bool DEFAULT 0 COMMENT 'Delete',
  PRIMARY KEY (`id_group`, `id_topping`)
);

CREATE TABLE `CATEGORY` (
  `id` char(7) PRIMARY KEY NOT NULL,
  `name` nvarchar(50) UNIQUE NOT NULL,
  `isDelete` bool DEFAULT 0 COMMENT 'Delete'
);

CREATE TABLE `GIA_MON_AN` (
  `id_mon_an` char(12),
  `size` ENUM ('S', 'M', 'L','UN') NULL COMMENT 'Size của món',
  `price` int(8) NOT NULL COMMENT 'Giá bán của món',
  `ngayCN` date COMMENT 'Ngày Cập Nhật',
  PRIMARY KEY (`id_mon_an`, `size`, `ngayCN`)
);

CREATE TABLE `CT_MON_AN` (
  `id_mon_an` char(12),
  `size` ENUM ('S', 'M', 'L','UN') NULL COMMENT 'Size của món',
  `dinhluong` int(8) NOT NULL COMMENT 'Định lượng',
  `donvicb` char(7) NOT NULL COMMENT 'Đơn vị cơ bản',
  PRIMARY KEY (`id_mon_an`, `size`)
);

CREATE TABLE `HOA_DON` (
  `id` char(16) PRIMARY KEY NOT NULL ,
  `ngaylap` date NOT NULL COMMENT 'Ngày Lập Hóa Đơn',
  `order_amount` int(8) COMMENT 'Tổng tiền theo chi tiết hóa đơn',
  `discount_amount` int(8) COMMENT 'Tổng chiết khấu + giảm giá',
  `status` ENUM ('KH_HUY', 'KH_NHAN', 'CH_XULY', 'CH_NHAN', 'CH_GIAO', 'CH_HUY') NOT NULL COMMENT 'Trạng thái của đơn',
  `ghichu` nvarchar(100) COMMENT 'Ghi chú cho đơn',
  `km` char(14) COMMENT 'Khuyến Mãi',
  `pttt` char(6) NOT NULL COMMENT 'Phương thức thanh toán',
  `diachi` char(12) NOT NULL COMMENT 'Địa chỉ giao hàng',
  `nhanvien` char(10) NOT NULL COMMENT 'Nhân viên bán hàng'
);

CREATE TABLE `CT_HOA_DON` (
  `id_hoa_don` char(16) COMMENT 'Mã Hóa Đơn',
  `stt` int(3) NOT NULL COMMENT 'Số thứ tự',
  `ghichu` nvarchar(50) COMMENT 'Ghi chú chi tiết',
  `don_gia` int(8) NOT NULL COMMENT 'Đơn giá sản phẩm',
  PRIMARY KEY (`id_hoa_don`, `stt`)
);

CREATE TABLE `CTHD_MON` (
  `id_hoa_don` char(16) COMMENT 'Mã Hóa Đơn',
  `stt` int(3) NOT NULL COMMENT 'Số thứ tự',
  `id_mon_chinh` char(12) COMMENT 'Món',
  `size` ENUM ('S', 'M', 'L') COMMENT 'Size món',
  `quantity` int(3) DEFAULT 1 COMMENT 'Số lượng món',
  PRIMARY KEY (`id_hoa_don`, `stt`)
);

CREATE TABLE `CTHD_TOPPING` (
  `id_hoa_don` char(16) COMMENT 'Mã Hóa Đơn',
  `stt` int(3) COMMENT 'Số thứ tự',
  `id_topping` char(12) COMMENT 'Topping',
  `quantity` int(3) DEFAULT 1 COMMENT 'Số lượng topping',
  PRIMARY KEY (`id_hoa_don`, `stt`)
);

CREATE TABLE `PTTT` (
  `id` char(6) PRIMARY KEY NOT NULL ,
  `name` nvarchar(50) UNIQUE NOT NULL,
  `isDelete` bool DEFAULT 0 COMMENT 'Delete'
);

CREATE TABLE `KHUYEN_MAI` (
  `id` char(14) PRIMARY KEY NOT NULL ,
  `startDate` date NOT NULL COMMENT 'Ngày bắt đầu',
  `endDate` date NOT NULL COMMENT 'Ngày kết thúc',
  `donviKM` bool DEFAULT 0 COMMENT 'Đơn vị được sử dụng',
  `value` int(8) NOT NULL COMMENT 'Giá trị áp dụng theo đơn vị',
  `isDelete` bool DEFAULT 0 COMMENT 'Delete',
  `des` nvarchar(500) COMMENT 'Mô tả khuyến mãi'
);

CREATE TABLE `CT_KM` (
  `id_km` char(14) PRIMARY KEY NOT NULL COMMENT 'Mã Khuyến Mãi',
  `id_mon` char(12) COMMENT 'Món Khuyến Mãi'
);

CREATE TABLE `KHACH_HANG` (
  `id` char(14) PRIMARY KEY NOT NULL ,
  `name` nvarchar(50) NOT NULL,
  `phone` varchar(15) UNIQUE NOT NULL COMMENT 'Số điện thoại',
  `isDelete` bool DEFAULT 0 COMMENT 'Delete'
);

CREATE TABLE `DIACHI_KH` (
  `id` char(12) PRIMARY KEY NOT NULL ,
  `id_kh` char(14) COMMENT 'Mã Khách Hàng',
  `address` nvarchar(200) NOT NULL COMMENT 'Số nhà, tên đường',
  `district` nvarchar(50) NOT NULL COMMENT 'Quận',
  `ward` nvarchar(50) NOT NULL COMMENT 'Phường',
  `city` nvarchar(50) NOT NULL COMMENT 'Thành phố',
  `isDelete` bool DEFAULT 0 COMMENT 'Delete'
);

CREATE TABLE `TAI_KHOAN` (
  `username` varchar(30) PRIMARY KEY,
  `password` varchar(20),
  `type` bool DEFAULT 0 COMMENT 'Phân loại Tài Khoản',
  `id_type` varchar(14) COMMENT 'Mã Thông Tin Tài Khoản',
  `isDelete` bool DEFAULT 0 COMMENT 'Delete'
);

CREATE TABLE `NHAN_VIEN` (
  `id` char(10) PRIMARY KEY NOT NULL ,
  `name` nvarchar(50),
  `phone` varchar(12) NOT NULL COMMENT 'Số điện thoại',
  `chuc_vu` char(6) NOT NULL COMMENT 'Chức vụ',
  `isDelete` bool DEFAULT 0 COMMENT 'Delete'
);

CREATE TABLE `CHUC_VU` (
  `id` char(6) PRIMARY KEY NOT NULL ,
  `name` nvarchar(50),
  `des` nvarchar(100) COMMENT 'Mô tả chức vụ',
  `isDelete` bool DEFAULT 0 COMMENT 'Delete'
);

CREATE TABLE `QUYEN_TRUY_CAP` (
  `id` char(6) PRIMARY KEY NOT NULL ,
  `name` nvarchar(100) UNIQUE NOT NULL,
  `isDelete` bool DEFAULT 0 COMMENT 'Delete'
);

CREATE TABLE `CT_CHUC_VU` (
  `id_chucvu` char(6) COMMENT 'Mã Chức Vụ',
  `id_qtc` char(6) COMMENT 'Mã Quyền Truy Cập',
  `show` bool DEFAULT 1 COMMENT 'Chức năng Xem',
  `insert` bool DEFAULT 1 COMMENT 'Chức năng Thêm',
  `edit` bool DEFAULT 1 COMMENT 'Chức năng Sửa',
  `delete` bool DEFAULT 1 COMMENT 'Chức năng Xóa',
  PRIMARY KEY (`id_chucvu`, `id_qtc`)
);

CREATE TABLE `DON_VI_TINH` (
  `id` char(7) PRIMARY KEY NOT NULL ,
  `name` nvarchar(20) UNIQUE NOT NULL,
  `isDelete` bool DEFAULT 0 COMMENT 'Delete'
);

CREATE TABLE `DOI_DON_VI` (
  `from_unit` char(7) COMMENT 'Đơn vị cần đổi',
  `to_unit` char(7) COMMENT 'Đơn vị được đổi',
  `ratio` float(10,2) NOT NULL COMMENT 'Tỷ lệ',
  `id_ad` varchar(12) COMMENT 'Đối tượng áp dụng',
  PRIMARY KEY (`id_ad`, `from_unit`)
);

CREATE TABLE `HANG_HOA` (
  `id` char(10) PRIMARY KEY NOT NULL ,
  `name` nvarchar(100),
  `type` ENUM ('NL', 'SC', 'UN') NULL COMMENT 'Loại Hàng Hóa',
  `donvicb` char(7) COMMENT 'Đơn vị cơ bản',
  `isDelete` bool DEFAULT 0 COMMENT 'Delete',
  `isTracking` bool DEFAULT 1 COMMENT 'Theo dõi tồn kho',
  `SLton` int(8) DEFAULT 0 COMMENT 'Số lượng tồn hiện tại',
  `SLmin` int(8) DEFAULT 0 COMMENT 'Số lượng tồn tối thiểu',
  `SLmax` int(8) DEFAULT 0 COMMENT 'Số lượng tồn tối đa'
);

CREATE TABLE `CONG_THUC` (
  `id` char(12) PRIMARY KEY NOT NULL ,
  `id_thanh_pham` varchar(12) NOT NULL COMMENT 'Thành phẩm thu được',
  `type` bool NOT NULL COMMENT 'Loại Công thức',
  `des` nvarchar(50) COMMENT 'Mô tả công thức',
  `donvi` char(7) COMMENT 'Đơn vị thành phẩm',
  `isDelete` bool DEFAULT 0 COMMENT 'Delete'
);

CREATE TABLE `CT_CONG_THUC` (
  `id_ct` char(12) NOT NULL COMMENT 'Mã Công Thức',
  `id_nguyenlieu` char(10) COMMENT 'Nguyên Liệu',
  `donvi_nguyenlieu` char(7) NOT NULL COMMENT 'Đơn vị nguyên liệu',
  `amount_nguyenlieu` int(8) NOT NULL COMMENT 'Tỷ lệ nguyên liệu',
  PRIMARY KEY (`id_nguyenlieu`, `id_ct`)
);

CREATE TABLE `PHIEU_NHAP_KHO` (
  `id` char(12) PRIMARY KEY NOT NULL,
  `ngaynhap` date NOT NULL COMMENT 'Ngày nhập hàng',
  `type` bool NOT NULL COMMENT 'Phân loại nhập kho',
  `total` int(8) NOT NULL COMMENT 'Tổng tiền nhập hàng',
  `isDelete` bool DEFAULT 0 COMMENT 'Delete',
  `nhanvien` char(10) COMMENT 'Nhân viên phụ trách',
  `id_ncc` char(7) COMMENT 'Nhà cung cấp'
);

CREATE TABLE `CT_NHAP_KHO` (
  `id_pn` char(12) COMMENT 'Mã Phiếu Nhập Kho',
  `id_hang_hoa` char(10) COMMENT 'Hàng hóa được nhập',
  `amount` int(8) NOT NULL COMMENT 'Số lượng',
  `cost` int(8) NOT NULL COMMENT 'Đơn giá / Giá gốc',
  `don_vi` char(10) COMMENT 'Đơn vị nhập kho',
  PRIMARY KEY (`id_pn`, `id_hang_hoa`)
);

CREATE TABLE `NCC` (
  `id` char(7) PRIMARY KEY NOT NULL ,
  `name` nvarchar(50) UNIQUE NOT NULL COMMENT 'Tên Nhà Cung Cấp',
  `phone` varchar(12) NOT NULL COMMENT 'Số điện thoại liên lạc',
  `isDelete` bool DEFAULT 0 COMMENT 'Delete',
  `address` nvarchar(50) COMMENT 'Số nhà, tên đường',
  `ward` nvarchar(50) COMMENT 'Phường',
  `district` nvarchar(50) COMMENT 'Quận',
  `city` nvarchar(50) COMMENT 'Thành phố'
);

CREATE TABLE `PHIEU_XUAT_KHO` (
  `id` char(11) PRIMARY KEY NOT NULL,
  `ngayxuat` date COMMENT 'Ngày Xuất Kho',
  `isDelete` bool DEFAULT 0 COMMENT 'Delete',
  `nhanvien` char(10) NOT NULL COMMENT 'Nhân viên phụ trách'
);

CREATE TABLE `CT_XUAT_KHO` (
  `id_px` char(11) COMMENT 'Mã Phiếu Xuất Kho',
  `id_hang_hoa` char(10) COMMENT 'Hàng Hóa Xuất Kho',
  `amount` int(8) NOT NULL COMMENT 'Số lượng',
  `don_vi` char(10) COMMENT 'Đơn vị xuất kho',
  PRIMARY KEY (`id_px`, `id_hang_hoa`)
);


ALTER TABLE `MON_AN` ADD FOREIGN KEY (`id_cate`) REFERENCES `CATEGORY` (`id`);

ALTER TABLE `MON_AN` ADD FOREIGN KEY (`id_cus`) REFERENCES `CUSTOMIZATION` (`id`);

ALTER TABLE `CUS_GROUP` ADD FOREIGN KEY (`id_cus`) REFERENCES `CUSTOMIZATION` (`id`);

ALTER TABLE `CUS_GROUP_TOPPING` ADD FOREIGN KEY (`id_group`) REFERENCES `CUS_GROUP` (`id`);

ALTER TABLE `CUS_GROUP_TOPPING` ADD FOREIGN KEY (`id_topping`) REFERENCES `MON_AN` (`id`);

ALTER TABLE `GIA_MON_AN` ADD FOREIGN KEY (`id_mon_an`) REFERENCES `MON_AN` (`id`);

ALTER TABLE `CT_MON_AN` ADD FOREIGN KEY (`id_mon_an`) REFERENCES `MON_AN` (`id`);

ALTER TABLE `CT_MON_AN` ADD FOREIGN KEY (`donvicb`) REFERENCES `DON_VI_TINH` (`id`);

ALTER TABLE `HOA_DON` ADD FOREIGN KEY (`km`) REFERENCES `KHUYEN_MAI` (`id`);

ALTER TABLE `HOA_DON` ADD FOREIGN KEY (`pttt`) REFERENCES `PTTT` (`id`);

ALTER TABLE `HOA_DON` ADD FOREIGN KEY (`diachi`) REFERENCES `DIACHI_KH` (`id`);

ALTER TABLE `HOA_DON` ADD FOREIGN KEY (`nhanvien`) REFERENCES `NHAN_VIEN` (`id`);

ALTER TABLE `CT_HOA_DON` ADD FOREIGN KEY (`id_hoa_don`) REFERENCES `HOA_DON` (`id`);

ALTER TABLE `CTHD_MON` ADD FOREIGN KEY (`id_hoa_don`) REFERENCES `CT_HOA_DON` (`id_hoa_don`);

ALTER TABLE `CTHD_MON` ADD FOREIGN KEY (`id_mon_chinh`) REFERENCES `CT_MON_AN` (`id_mon_an`);

ALTER TABLE `CTHD_TOPPING` ADD FOREIGN KEY (`id_hoa_don`) REFERENCES `CT_HOA_DON` (`id_hoa_don`);

ALTER TABLE `CT_KM` ADD FOREIGN KEY (`id_km`) REFERENCES `KHUYEN_MAI` (`id`);

ALTER TABLE `CT_KM` ADD FOREIGN KEY (`id_mon`) REFERENCES `MON_AN` (`id`);

ALTER TABLE `DIACHI_KH` ADD FOREIGN KEY (`id_kh`) REFERENCES `KHACH_HANG` (`id`);

ALTER TABLE `TAI_KHOAN` ADD FOREIGN KEY (`id_type`) REFERENCES `NHAN_VIEN` (`id`);

ALTER TABLE `NHAN_VIEN` ADD FOREIGN KEY (`chuc_vu`) REFERENCES `CHUC_VU` (`id`);

ALTER TABLE `CT_CHUC_VU` ADD FOREIGN KEY (`id_chucvu`) REFERENCES `CHUC_VU` (`id`);

ALTER TABLE `CT_CHUC_VU` ADD FOREIGN KEY (`id_qtc`) REFERENCES `QUYEN_TRUY_CAP` (`id`);

ALTER TABLE `DOI_DON_VI` ADD FOREIGN KEY (`from_unit`) REFERENCES `DON_VI_TINH` (`id`);

ALTER TABLE `DOI_DON_VI` ADD FOREIGN KEY (`to_unit`) REFERENCES `DON_VI_TINH` (`id`);

ALTER TABLE `DOI_DON_VI` ADD FOREIGN KEY (`id_ad`) REFERENCES `CT_MON_AN` (`id_mon_an`);

ALTER TABLE `DOI_DON_VI` ADD FOREIGN KEY (`id_ad`) REFERENCES `HANG_HOA` (`id`);

ALTER TABLE `HANG_HOA` ADD FOREIGN KEY (`donvicb`) REFERENCES `DON_VI_TINH` (`id`);

ALTER TABLE `CONG_THUC` ADD FOREIGN KEY (`id_thanh_pham`) REFERENCES `MON_AN` (`id`);

ALTER TABLE `CONG_THUC` ADD FOREIGN KEY (`id_thanh_pham`) REFERENCES `HANG_HOA` (`id`);

ALTER TABLE `CONG_THUC` ADD FOREIGN KEY (`donvi`) REFERENCES `DON_VI_TINH` (`id`);

ALTER TABLE `CT_CONG_THUC` ADD FOREIGN KEY (`id_ct`) REFERENCES `CONG_THUC` (`id`);

ALTER TABLE `CT_CONG_THUC` ADD FOREIGN KEY (`id_nguyenlieu`) REFERENCES `HANG_HOA` (`id`);

ALTER TABLE `CT_CONG_THUC` ADD FOREIGN KEY (`donvi_nguyenlieu`) REFERENCES `DON_VI_TINH` (`id`);

ALTER TABLE `PHIEU_NHAP_KHO` ADD FOREIGN KEY (`nhanvien`) REFERENCES `NHAN_VIEN` (`id`);

ALTER TABLE `PHIEU_NHAP_KHO` ADD FOREIGN KEY (`id_ncc`) REFERENCES `NCC` (`id`);

ALTER TABLE `CT_NHAP_KHO` ADD FOREIGN KEY (`id_pn`) REFERENCES `PHIEU_NHAP_KHO` (`id`);

ALTER TABLE `CT_NHAP_KHO` ADD FOREIGN KEY (`id_hang_hoa`) REFERENCES `HANG_HOA` (`id`);

ALTER TABLE `CT_NHAP_KHO` ADD FOREIGN KEY (`don_vi`) REFERENCES `DON_VI_TINH` (`id`);

ALTER TABLE `PHIEU_XUAT_KHO` ADD FOREIGN KEY (`nhanvien`) REFERENCES `NHAN_VIEN` (`id`);

ALTER TABLE `CT_XUAT_KHO` ADD FOREIGN KEY (`id_px`) REFERENCES `PHIEU_XUAT_KHO` (`id`);

ALTER TABLE `CT_XUAT_KHO` ADD FOREIGN KEY (`id_hang_hoa`) REFERENCES `HANG_HOA` (`id`);

ALTER TABLE `CT_XUAT_KHO` ADD FOREIGN KEY (`don_vi`) REFERENCES `DON_VI_TINH` (`id`);


INSERT INTO `CATEGORY` (`id`, `name`, `isDelete`) VALUES ('CATE000', 'UNCATEGORY', '0');
INSERT INTO `CATEGORY` (`id`, `name`, `isDelete`) VALUES ('CATE001', 'Trà Sữa', '0');
INSERT INTO `CATEGORY` (`id`, `name`, `isDelete`) VALUES ('CATE002', 'Trà Nguyên Vị', '0');
INSERT INTO `CATEGORY` (`id`, `name`, `isDelete`) VALUES ('CATE003', 'Trà Trái Cây', '0');
INSERT INTO `CATEGORY` (`id`, `name`, `isDelete`) VALUES ('CATE004', 'Nước ép', '0');
INSERT INTO `CATEGORY` (`id`, `name`, `isDelete`) VALUES ('CATE005', 'Đá xay', '0');

INSERT INTO `customization` (`id`, `name`, `isDelete`) VALUES ('CUSTOM000','Customization 0', '0');
INSERT INTO `customization` (`id`, `name`, `isDelete`) VALUES ('CUSTOM001','Customization 1', '0');

INSERT INTO `don_vi_tinh` (`id`, `name`, `isDelete`) VALUES ('UNIT000', 'g', '0');
INSERT INTO `don_vi_tinh` (`id`, `name`, `isDelete`) VALUES ('UNIT001', 'kg', '0');
INSERT INTO `don_vi_tinh` (`id`, `name`, `isDelete`) VALUES ('UNIT002', 'ml', '0');
INSERT INTO `don_vi_tinh` (`id`, `name`, `isDelete`) VALUES ('UNIT003', 'l', '0');

INSERT INTO `mon_an` (`id`, `name`, `countSale`, `type`, `isDelete`, `id_cate`, `id_cus`, `des`, `img`) VALUES ('PRODUCT10000', 'Trân Châu Đen', '0', '1', '0', 'CATE000', NULL, NULL, NULL);
INSERT INTO `mon_an` (`id`, `name`, `countSale`, `type`, `isDelete`, `id_cate`, `id_cus`, `des`, `img`) VALUES ('PRODUCT10001', 'Trân Châu Trắng', '0', '1', '0', 'CATE000', NULL, NULL, NULL);
INSERT INTO `mon_an` (`id`, `name`, `countSale`, `type`, `isDelete`, `id_cate`, `id_cus`, `des`, `img`) VALUES ('PRODUCT00002', 'Trà Sữa Truyền Thống', '0', '0', '0', 'CATE001', 'CUSTOM000', NULL, NULL);
INSERT INTO `mon_an` (`id`, `name`, `countSale`, `type`, `isDelete`, `id_cate`, `id_cus`, `des`, `img`) VALUES ('PRODUCT00003', 'Trà Sữa Lài', '0', '0', '0', 'CATE001', 'CUSTOM000', NULL, NULL);
INSERT INTO `mon_an` (`id`, `name`, `countSale`, `type`, `isDelete`, `id_cate`, `id_cus`, `des`, `img`) VALUES ('PRODUCT00004', 'Trà Sữa Gạo Rang', '0', '0', '0', 'CATE001', 'CUSTOM000', NULL, NULL);
INSERT INTO `mon_an` (`id`, `name`, `countSale`, `type`, `isDelete`, `id_cate`, `id_cus`, `des`, `img`) VALUES ('PRODUCT00005', 'Trà Sữa Olong', '0', '0', '0', 'CATE001', 'CUSTOM000', NULL, NULL);
INSERT INTO `mon_an` (`id`, `name`, `countSale`, `type`, `isDelete`, `id_cate`, `id_cus`, `des`, `img`) VALUES ('PRODUCT00006', 'Hồng Trà Trân Châu', '0', '0', '0', 'CATE002', NULL, NULL, NULL);
INSERT INTO `mon_an` (`id`, `name`, `countSale`, `type`, `isDelete`, `id_cate`, `id_cus`, `des`, `img`) VALUES ('PRODUCT00007', 'Trà Lài Nguyên Vị', '0', '0', '0', 'CATE002', NULL, NULL, NULL);
INSERT INTO `mon_an` (`id`, `name`, `countSale`, `type`, `isDelete`, `id_cate`, `id_cus`, `des`, `img`) VALUES ('PRODUCT00008', 'Trà Olong Nguyên Vị', '0', '0', '0', 'CATE002', NULL, NULL, NULL);
INSERT INTO `mon_an` (`id`, `name`, `countSale`, `type`, `isDelete`, `id_cate`, `id_cus`, `des`, `img`) VALUES ('PRODUCT00009', 'Trà Vải Lài', '0', '0', '0', 'CATE003', NULL, NULL, NULL);
INSERT INTO `mon_an` (`id`, `name`, `countSale`, `type`, `isDelete`, `id_cate`, `id_cus`, `des`, `img`) VALUES ('PRODUCT00010', 'Trà Mãng Cầu', '0', '0', '0', 'CATE003', NULL, NULL, NULL);
INSERT INTO `mon_an` (`id`, `name`, `countSale`, `type`, `isDelete`, `id_cate`, `id_cus`, `des`, `img`) VALUES ('PRODUCT00011', 'Trà Dâu Tươi', '0', '0', '0', 'CATE003', NULL, NULL, NULL);
INSERT INTO `mon_an` (`id`, `name`, `countSale`, `type`, `isDelete`, `id_cate`, `id_cus`, `des`, `img`) VALUES ('PRODUCT00012', 'Nước ép thơm', '0', '0', '0', 'CATE004', NULL, NULL, NULL);
INSERT INTO `mon_an` (`id`, `name`, `countSale`, `type`, `isDelete`, `id_cate`, `id_cus`, `des`, `img`) VALUES ('PRODUCT00013', 'Nước ép thơm dâu', '0', '0', '0', 'CATE004', NULL, NULL, NULL);
INSERT INTO `mon_an` (`id`, `name`, `countSale`, `type`, `isDelete`, `id_cate`, `id_cus`, `des`, `img`) VALUES ('PRODUCT00014', 'Nước ép dưa hấu', '0', '0', '0', 'CATE004', NULL, NULL, NULL);
INSERT INTO `mon_an` (`id`, `name`, `countSale`, `type`, `isDelete`, `id_cate`, `id_cus`, `des`, `img`) VALUES ('PRODUCT00015', 'Matcha đá xay', '0', '0', '0', 'CATE005', NULL, NULL, NULL);
INSERT INTO `mon_an` (`id`, `name`, `countSale`, `type`, `isDelete`, `id_cate`, `id_cus`, `des`, `img`) VALUES ('PRODUCT00016', 'Cookie đá xay', '0', '0', '0', 'CATE005', NULL, NULL, NULL);
INSERT INTO `mon_an` (`id`, `name`, `countSale`, `type`, `isDelete`, `id_cate`, `id_cus`, `des`, `img`) VALUES ('PRODUCT10017', '100% đường', '0', '1', '0', 'CATE000', NULL, NULL, NULL);
INSERT INTO `mon_an` (`id`, `name`, `countSale`, `type`, `isDelete`, `id_cate`, `id_cus`, `des`, `img`) VALUES ('PRODUCT10018', '70% đường', '0', '1', '0', 'CATE000', NULL, NULL, NULL);
INSERT INTO `mon_an` (`id`, `name`, `countSale`, `type`, `isDelete`, `id_cate`, `id_cus`, `des`, `img`) VALUES ('PRODUCT10019', '50% đường', '0', '1', '0', 'CATE000', NULL, NULL, NULL);
INSERT INTO `mon_an` (`id`, `name`, `countSale`, `type`, `isDelete`, `id_cate`, `id_cus`, `des`, `img`) VALUES ('PRODUCT10020', '100% đá', '0', '1', '0', 'CATE000', NULL, NULL, NULL);
INSERT INTO `mon_an` (`id`, `name`, `countSale`, `type`, `isDelete`, `id_cate`, `id_cus`, `des`, `img`) VALUES ('PRODUCT10021', '70% đá', '0', '1', '0', 'CATE000', NULL, NULL, NULL);
INSERT INTO `mon_an` (`id`, `name`, `countSale`, `type`, `isDelete`, `id_cate`, `id_cus`, `des`, `img`) VALUES ('PRODUCT10022', '50% đá', '0', '1', '0', 'CATE000', NULL, NULL, NULL);

INSERT INTO `cus_group` (`id`,`name`, `id_cus`, `isDelete`, `min`, `max`) VALUES ('CUSGRP000','Đường','CUSTOM000', '0', '1', '1');
INSERT INTO `cus_group` (`id`,`name`, `id_cus`, `isDelete`, `min`, `max`) VALUES ('CUSGRP001','Đá','CUSTOM000', '0', '1', '1');
INSERT INTO `cus_group` (`id`,`name`, `id_cus`, `isDelete`, `min`, `max`) VALUES ('CUSGRP002','Toping','CUSTOM000', '0', '0', '10');

INSERT INTO `cus_group_topping` (`id_group`, `id_topping`, `isDelete`) VALUES ('CUSGRP000', 'PRODUCT10017', '0');
INSERT INTO `cus_group_topping` (`id_group`, `id_topping`, `isDelete`) VALUES ('CUSGRP000', 'PRODUCT10018', '0');
INSERT INTO `cus_group_topping` (`id_group`, `id_topping`, `isDelete`) VALUES ('CUSGRP000', 'PRODUCT10019', '0');
INSERT INTO `cus_group_topping` (`id_group`, `id_topping`, `isDelete`) VALUES ('CUSGRP001', 'PRODUCT10020', '0');
INSERT INTO `cus_group_topping` (`id_group`, `id_topping`, `isDelete`) VALUES ('CUSGRP001', 'PRODUCT10021', '0');
INSERT INTO `cus_group_topping` (`id_group`, `id_topping`, `isDelete`) VALUES ('CUSGRP001', 'PRODUCT10022', '0');
INSERT INTO `cus_group_topping` (`id_group`, `id_topping`, `isDelete`) VALUES ('CUSGRP002', 'PRODUCT10000', '0');
INSERT INTO `cus_group_topping` (`id_group`, `id_topping`, `isDelete`) VALUES ('CUSGRP002', 'PRODUCT10001', '0');

INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT10000', 'UN', '5000', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT10001', 'UN', '5000', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT00002', 'M', '30000', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT00002', 'L', '35000', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT00003', 'M', '30000', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT00003', 'L', '35000', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT00004', 'M', '30000', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT00004', 'L', '35000', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT00005', 'M', '30000', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT00005', 'L', '35000', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT00006', 'M', '25000', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT00006', 'L', '30000', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT00007', 'M', '25000', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT00007', 'L', '30000', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT00008', 'M', '25000', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT00008', 'L', '30000', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT00009', 'M', '30000', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT00009', 'L', '35000', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT00010', 'L', '40000', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT00011', 'L', '35000', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT00012', 'M', '25000', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT00013', 'M', '25000', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT00015', 'M', '40000', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT00015', 'L', '45000', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT00016', 'M', '40000', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT00016', 'L', '45000', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT10017', 'UN', '0', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT10018', 'UN', '0', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT10019', 'UN', '0', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT10020', 'UN', '0', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT10021', 'UN', '0', '2024-04-30');
INSERT INTO `gia_mon_an` (`id_mon_an`, `size`, `price`, `ngayCN`) VALUES ('PRODUCT10022', 'UN', '0', '2024-04-30');

INSERT INTO `ct_mon_an` (`id_mon_an`, `size`, `dinhluong`, `donvicb`) VALUES ('PRODUCT00002', 'M', '150', 'UNIT002');
INSERT INTO `ct_mon_an` (`id_mon_an`, `size`, `dinhluong`, `donvicb`) VALUES ('PRODUCT00002', 'L', '200', 'UNIT002');
INSERT INTO `ct_mon_an` (`id_mon_an`, `size`, `dinhluong`, `donvicb`) VALUES ('PRODUCT10000', 'UN', '100', 'UNIT000');
INSERT INTO `ct_mon_an` (`id_mon_an`, `size`, `dinhluong`, `donvicb`) VALUES ('PRODUCT10001', 'UN', '50', 'UNIT000');



