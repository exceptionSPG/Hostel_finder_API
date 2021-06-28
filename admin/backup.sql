DROP TABLE admin;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(300) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updation_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO admin VALUES("1","admin","code.lpu1@gmail.com","Test@1234","2016-04-04 20:31:45","2020-12-01 10:34:45");
INSERT INTO admin VALUES("2","shiva","gyawalishiva14@gmail.com","admin","2020-07-21 02:37:20","2020-07-22 18:15:00");
INSERT INTO admin VALUES("3","Kapil","kapildevkota123@gmail.com","adminDHM","2020-07-21 02:54:14","2020-10-13 11:10:53");
INSERT INTO admin VALUES("5","khana gaye hai","edit@dmail.gom","editpassword","2020-10-12 06:16:25","2020-12-01 10:34:59");



DROP TABLE adminlog;

CREATE TABLE `adminlog` (
  `id` int(11) NOT NULL,
  `adminid` int(11) NOT NULL,
  `ip` varbinary(16) NOT NULL,
  `logintime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE courses;

CREATE TABLE `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_code` varchar(255) NOT NULL,
  `course_sn` varchar(255) NOT NULL,
  `course_fn` varchar(255) NOT NULL,
  `posting_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO courses VALUES("1","B10992","B.Tech","Bachelor  of Technology","2016-04-11 19:31:42");
INSERT INTO courses VALUES("2","BCOM1453","B.Com","Bachelor Of commerce ","2016-04-11 19:32:46");
INSERT INTO courses VALUES("3","BSC12","BSC","Bachelor  of Science","2016-04-11 19:33:23");
INSERT INTO courses VALUES("4","BC36356","BCA","Bachelor Of Computer Application","2016-04-11 19:34:18");
INSERT INTO courses VALUES("5","MCA565","MCA","Master of Computer Application","2016-04-11 19:34:40");
INSERT INTO courses VALUES("6","MBA75","MBA","Master of Business Administration","2016-04-11 19:34:59");
INSERT INTO courses VALUES("7","BE765","BE","Bachelor of Engineering","2016-04-11 19:35:19");



DROP TABLE hostel_details;

CREATE TABLE `hostel_details` (
  `hdid` int(11) NOT NULL AUTO_INCREMENT,
  `hostel_code` varchar(20) NOT NULL,
  `total_room_number` int(11) NOT NULL,
  `facility` varchar(300) DEFAULT NULL,
  `pricing` int(11) DEFAULT NULL,
  PRIMARY KEY (`hdid`),
  UNIQUE KEY `hostel_code_unique_key` (`hostel_code`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

INSERT INTO hostel_details VALUES("1","hf20201","50","Food, transport, wifi,","4000");
INSERT INTO hostel_details VALUES("8","hf20202","20","wifi, food, sanitation","4000");



DROP TABLE hostel_owner;

CREATE TABLE `hostel_owner` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `req_id` int(10) NOT NULL,
  `hostel_owner_name` varchar(50) NOT NULL,
  `hostel_name` varchar(200) NOT NULL,
  `hostel_location` varchar(200) NOT NULL,
  `hostel_type` varchar(10) NOT NULL,
  `contact_number` bigint(20) NOT NULL,
  `hostel_email` varchar(100) NOT NULL,
  `hostel_code` varchar(20) NOT NULL,
  `login_pwd` varchar(100) NOT NULL,
  `hostel_registered_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updation_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`sid`),
  KEY `request_fk` (`req_id`),
  CONSTRAINT `request_fk` FOREIGN KEY (`req_id`) REFERENCES `hostel_request` (`hrid`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

INSERT INTO hostel_owner VALUES("1","1","Bipuj solti","Like button boys hostel","Indrachowk, Narayanghat","Boys","9806597535","like@gmail.com","hf20201","hf20201","2020-06-29 18:15:00","2020-07-05 05:12:53");
INSERT INTO hostel_owner VALUES("2","2","Praman Ghimire","Green Durbar Hostel","Duwakot bhaktapur","Boys","9800000000","paramanghimire25@gmail.com","hf20202","hf20202","2020-07-04 13:56:01","");
INSERT INTO hostel_owner VALUES("3","3","Bipuj solta","Like button boys hostel","Indrachowk","Boys","9806597535","like@gmail.com","hf20203","hf20203","2020-07-04 13:56:19","2020-07-11 09:39:12");
INSERT INTO hostel_owner VALUES("5","4","Hari Bhai Aacharya","Engineering Boys Hostel","Bhaktapur","Boys","9867683096","engineeringboyshostel@gmail.com","hf20204","hf20204","2020-10-14 08:26:56","");
INSERT INTO hostel_owner VALUES("7","6","Minakshi Dev","Minu Girls Hostel","Birgunj","Girls","9806976453","minugirls@gmail.com","hf20206","hf20206","2020-10-15 16:01:09","");



DROP TABLE hostel_request;

CREATE TABLE `hostel_request` (
  `hrid` int(11) NOT NULL AUTO_INCREMENT,
  `hostel_name` varchar(100) NOT NULL,
  `hostel_location` varchar(200) NOT NULL,
  `loc_lattitude` double DEFAULT NULL,
  `loc_longitude` double DEFAULT NULL,
  `hostel_type` varchar(10) NOT NULL,
  `hostel_owner_name` varchar(200) NOT NULL,
  `contact_number` bigint(20) NOT NULL,
  `hostel_email` varchar(100) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`hrid`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

INSERT INTO hostel_request VALUES("1","Dhital Girls Hostel","Duwakot","","","Girls","Prakriti","986745362","hgj@gmail.com","2020-10-13 06:44:38","Approved");
INSERT INTO hostel_request VALUES("2","Green Durbar Hostel","Duwakot Bhaktapur","","","Boys","Praman Ghimire","9800000000","pramanghimire25@gmail.com","2020-10-14 03:08:31","Approved");
INSERT INTO hostel_request VALUES("3","Green Durbar Hostel","Duwakot Bhaktapur","","","Boys","Praman Ghimire","9800000000","pramanghimire25@gmail.com","2020-10-14 03:08:41","Approved");
INSERT INTO hostel_request VALUES("4","Engineering Boys Hostel","Bhaktapur","","","Boys","Hari Bhai Aacharya","9867683096","engineeringboyshostel@gmail.com","2020-10-14 07:28:05","Approved");
INSERT INTO hostel_request VALUES("6","Minu Girls Hostel","Birgunj","","","Girls","Minakshi Dev","9806976453","minugirls@gmail.com","2020-10-15 15:57:44","Approved");
INSERT INTO hostel_request VALUES("8","Demo Boys Hostel","Lalitpur","","","Boys","Dan Bahadur","9867456320","hosteldemo@gmail.com","2020-10-16 04:04:15","Pending");
INSERT INTO hostel_request VALUES("12","Middle pt ebhs Hostel","Mahalaxmisthan, Lalitpur","27.65","85.78","Boys","Prakriti Gyawali","9867345241","hasikhel@hostel.com","2020-12-01 10:42:29","Pending");
INSERT INTO hostel_request VALUES("14","Middle pt ebhs Hostel","Mahalaxmisthan, Lalitpur","27.65","85.78","Boys","Prakriti Gyawali","9867345241","hasikhel@hostel.com","2020-12-01 11:05:46","Pending");
INSERT INTO hostel_request VALUES("15","Middle pt ebhs Hostel","Mahalaxmisthan, Lalitpur","27.65","85.78","Boys","Prakriti Gyawali","9867345241","hasikhel@hostel.com","2020-12-01 11:10:51","Pending");
INSERT INTO hostel_request VALUES("16","Middle pt ebhs Hostel","Mahalaxmisthan, Lalitpur","27.65","85.78","Boys","Prakriti Gyawali","9867345241","hasikhel@hostel.com","2020-12-01 11:22:52","Pending");
INSERT INTO hostel_request VALUES("17","Middle pt ebhs Hostel","Mahalaxmisthan, Lalitpur","27.65","85.78","Boys","Prakriti Gyawali","9867345241","hasikhel@hostel.com","2020-12-01 11:23:25","Pending");
INSERT INTO hostel_request VALUES("18","Middle pt ebhs Hostel","Mahalaxmisthan, Lalitpur","27.65","85.78","Boys","Prakriti Gyawali","9867345241","hasikhel@hostel.com","2020-12-01 11:24:18","Pending");
INSERT INTO hostel_request VALUES("19","Middle pt ebhs Hostel","Mahalaxmisthan, Lalitpur","27.65","85.78","Boys","Prakriti Gyawali","9867345241","hasikhel@hostel.com","2020-12-01 11:25:16","Pending");
INSERT INTO hostel_request VALUES("20","Middle pt ebhs Hostel","Mahalaxmisthan, Lalitpur","27.65","85.78","Boys","Prakriti Gyawali","9867345241","hasikhel@hostel.com","2020-12-01 11:26:22","Pending");



DROP TABLE hosteluser;

CREATE TABLE `hosteluser` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updation_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;

INSERT INTO hosteluser VALUES("10","shiva","shiav@gmail.com","$2y$10$rj5YU9HvuT/GMjOzgop5ZeundxQcciFE2LPm0aWDlrr","2020-07-01 06:32:28","");
INSERT INTO hosteluser VALUES("11","shivavai","gyawalivai@gmail.com","$2y$10$UELNiunZ5XuN7FxaYmfiz.pu2t9KOyl0yl9C87zugqu","2020-07-01 10:05:08","");
INSERT INTO hosteluser VALUES("12","sabite","sabite@","sabite","2020-07-04 15:15:33","");
INSERT INTO hosteluser VALUES("13","test","test@gmail.com","$2y$10$h4jAv/pCx.ZEc7lLC/MCmO1z5GqolZeeihafl9ytRtE","2020-07-04 15:49:59","");
INSERT INTO hosteluser VALUES("14","suman vai","sumanvai@gmail.com","suman","2020-07-05 02:16:54","2020-07-17 08:16:26");
INSERT INTO hosteluser VALUES("16","vanja","vanja@gmail.com","1234","2020-07-11 09:51:02","");
INSERT INTO hosteluser VALUES("17","vanja","vanja@gmail.com1","1234","2020-07-11 11:26:12","");
INSERT INTO hosteluser VALUES("18","name","email@email.com","password","2020-07-11 11:45:57","");
INSERT INTO hosteluser VALUES("19","name is","email2@email.com","password","2020-07-11 11:47:03","");
INSERT INTO hosteluser VALUES("20","name","email3@email.com","password","2020-07-11 11:49:59","");
INSERT INTO hosteluser VALUES("22","name","email4@email.com","password","2020-07-12 07:01:39","");
INSERT INTO hosteluser VALUES("24","name","2email@email.com","password","2020-07-12 07:29:07","");
INSERT INTO hosteluser VALUES("25","Suman Kharel","sumankharel666@gmail.com","suman","2020-07-12 10:58:17","");
INSERT INTO hosteluser VALUES("26","Sakshu vanja","sakshu@gmail.com","1234","2020-07-13 04:22:20","");
INSERT INTO hosteluser VALUES("27","pradeep vai","pradeep@gmail.com","1234","2020-07-13 09:00:08","");
INSERT INTO hosteluser VALUES("28","gunnidhi","gokul@gmail.com","1234","2020-07-14 15:04:06","");
INSERT INTO hosteluser VALUES("30","Kapil","kpd@gmail.com","1234","2020-10-08 15:08:45","");
INSERT INTO hosteluser VALUES("32","keshab","keshav@gmail.com","keshav","2020-10-13 13:04:34","");
INSERT INTO hosteluser VALUES("33","anything","anything@gmail.com","nothing","2020-11-14 17:56:26","");
INSERT INTO hosteluser VALUES("34","Kiran vai","kiran1369@gmail.com","1234","2020-11-17 09:05:06","");



DROP TABLE registration;

CREATE TABLE `registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roomno` int(11) NOT NULL,
  `seater` int(11) NOT NULL,
  `feespm` int(11) NOT NULL,
  `foodstatus` int(11) NOT NULL,
  `stayfrom` date NOT NULL,
  `duration` int(11) NOT NULL,
  `course` varchar(500) NOT NULL,
  `regno` int(11) NOT NULL,
  `firstName` varchar(500) NOT NULL,
  `middleName` varchar(500) NOT NULL,
  `lastName` varchar(500) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `contactno` bigint(11) NOT NULL,
  `emailid` varchar(500) NOT NULL,
  `egycontactno` bigint(11) NOT NULL,
  `guardianName` varchar(500) NOT NULL,
  `guardianRelation` varchar(500) NOT NULL,
  `guardianContactno` bigint(11) NOT NULL,
  `corresAddress` varchar(500) NOT NULL,
  `corresCIty` varchar(500) NOT NULL,
  `corresState` varchar(500) NOT NULL,
  `corresPincode` int(11) NOT NULL,
  `pmntAddress` varchar(500) NOT NULL,
  `pmntCity` varchar(500) NOT NULL,
  `pmnatetState` varchar(500) NOT NULL,
  `pmntPincode` int(11) NOT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO registration VALUES("6","100","5","8000","0","2016-04-22","5","Bachelor  of Technology","10806121","code","","projects","male","8285703354","code.lpu1@gmail.com","0","XYZ","Mother","8285703354","H n0 18/1 Bihari Puram Phase-1 Melrose Bye Pass","Aligarh","EPE","202001","H n0 18/1 Bihari Puram Phase-1 Melrose Bye Pass","Aligarh","EPE","202001","2016-04-16 08:24:09","");
INSERT INTO registration VALUES("7","100","5","8000","1","2016-06-17","4","Bachelor of Engineering","108061211","code","test","projects","male","8467067344","test@gmail.com","8285703354","test","test","9999857868","H no- 18/1 Bihari puram phase-1 melrose bye pass","Aligarh","EPE","202001","H no- 18/1 Bihari puram phase-1 melrose bye pass","Aligarh","EPE","202001","2016-06-23 11:54:35","");
INSERT INTO registration VALUES("8","112","3","4000","0","2016-06-27","5","Bachelor  of Science","102355","Harry","projects","Singh","male","6786786786","Harry@gmail.com","789632587","demo","demo","1234567890","New Delhi","Delhi","Delhi (NCT)","110001","New Delhi","Delhi","Delhi (NCT)","110001","2016-06-26 16:31:08","");
INSERT INTO registration VALUES("9","132","5","2000","1","2016-06-28","6","Bachelor of Engineering","586952","Benjamin","","projects","male","8596185625","Benjamin@gmail.com","8285703354","demo","demo","8285703354","H no- 18/1 Bihari puram phase-1 melrose bye pass","Aligarh","EPE","202001","H no- 18/1 Bihari puram phase-1 melrose bye pass","Aligarh","EPE","202001","2016-06-26 16:40:07","");
INSERT INTO registration VALUES("10","132","7","2000","0","2020-06-25","2","Bachelor  of Science","7676","vanja","","twaake","male","9806597535","vanja@gmail.com","0","000","000","0","000","000","Andhra Pradesh","0","000","000","Andhra Pradesh","0","2020-06-25 07:50:51","");



DROP TABLE rooms;

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seater` int(11) NOT NULL,
  `room_no` int(11) NOT NULL,
  `fees` int(11) NOT NULL,
  `posting_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO rooms VALUES("1","100","100","8000","2016-04-11 22:45:43");
INSERT INTO rooms VALUES("2","2","201","6000","2016-04-12 01:30:47");
INSERT INTO rooms VALUES("3","2","200","6000","2016-04-12 01:30:58");
INSERT INTO rooms VALUES("4","3","112","4000","2016-04-12 01:31:07");
INSERT INTO rooms VALUES("5","5","132","2000","2016-04-12 01:31:15");



DROP TABLE states;

CREATE TABLE `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `State` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

INSERT INTO states VALUES("1","Andaman and Nicobar Island (UT)");
INSERT INTO states VALUES("2","Andhra Pradesh");
INSERT INTO states VALUES("3","Arunachal Pradesh");
INSERT INTO states VALUES("4","Assam");
INSERT INTO states VALUES("5","Bihar");
INSERT INTO states VALUES("6","Chandigarh (UT)");
INSERT INTO states VALUES("7","Chhattisgarh");
INSERT INTO states VALUES("8","Dadra and Nagar Haveli (UT)");
INSERT INTO states VALUES("9","Daman and Diu (UT)");
INSERT INTO states VALUES("10","Delhi (NCT)");
INSERT INTO states VALUES("11","Goa");
INSERT INTO states VALUES("12","Gujarat");
INSERT INTO states VALUES("13","Haryana");
INSERT INTO states VALUES("14","Himachal Pradesh");
INSERT INTO states VALUES("15","Jammu and Kashmir");
INSERT INTO states VALUES("16","Jharkhand");
INSERT INTO states VALUES("17","Karnataka");
INSERT INTO states VALUES("18","Kerala");
INSERT INTO states VALUES("19","Lakshadweep (UT)");
INSERT INTO states VALUES("20","Madhya Pradesh");
INSERT INTO states VALUES("21","Maharashtra");
INSERT INTO states VALUES("22","Manipur");
INSERT INTO states VALUES("23","Meghalaya");
INSERT INTO states VALUES("24","Mizoram");
INSERT INTO states VALUES("25","Nagaland");
INSERT INTO states VALUES("26","Odisha");
INSERT INTO states VALUES("27","Puducherry (UT)");
INSERT INTO states VALUES("28","Punjab");
INSERT INTO states VALUES("29","Rajastha");
INSERT INTO states VALUES("30","Sikkim");
INSERT INTO states VALUES("31","Tamil Nadu");
INSERT INTO states VALUES("32","Telangana");
INSERT INTO states VALUES("33","Tripura");
INSERT INTO states VALUES("34","Uttarakhand");
INSERT INTO states VALUES("35","EPE");
INSERT INTO states VALUES("36","West Bengal");



DROP TABLE user_info;

CREATE TABLE `user_info` (
  `uiid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `user_phone_number` varchar(20) NOT NULL,
  `user_address` varchar(100) NOT NULL,
  `user_DOB` date NOT NULL,
  `user_gender` varchar(10) DEFAULT NULL,
  `user_guardian_name` varchar(50) NOT NULL,
  `user_guardian_contact_number` varchar(20) NOT NULL,
  `education` varchar(20) NOT NULL,
  `about_you` varchar(300) NOT NULL,
  `updation_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`uiid`),
  KEY `user_info_foreign` (`uid`),
  CONSTRAINT `user_info_foreign` FOREIGN KEY (`uid`) REFERENCES `hosteluser` (`uid`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

INSERT INTO user_info VALUES("7","14","9812967055","","2055-06-19","female","Krishna","9867457622","+2","I am handsome girl.","2020-07-20 11:31:06");
INSERT INTO user_info VALUES("8","27","9811552688","benimanipur ko top toll","2058-11-18","","keshav solta","9818618836","+2 running","lekhana ","");
INSERT INTO user_info VALUES("12","12","9811552688","benimanipur ko top toll","2058-11-18","male","keshav solta","9818618836","+2 running","lekhana ","");
INSERT INTO user_info VALUES("13","28","98676","yert","0000-00-00","Male","ter","9867","School level, Scienc","something","");
INSERT INTO user_info VALUES("14","16","98676","tanahu","0000-00-00","Male","vinaju","9867","+2, Science","some like button footdablit","");
INSERT INTO user_info VALUES("15","18","98676","email","0000-00-00","Male","keshai","9867","School level, Scienc","email@email.com","");
INSERT INTO user_info VALUES("16","19","98676","email2","0000-00-00","Male","email2","9867","School level, Scienc","something foe","");
INSERT INTO user_info VALUES("18","24","1231","bhutaha","2001-07-17","Female","twaa","1221","+2, Management","it\'s testing about date of birth.","");
INSERT INTO user_info VALUES("20","26","9869534590","Sardi, Chukaha","2006-07-17","Male","Syamu dd","9869534591","School level, Scienc","kasto kei hunxa ra.","2020-09-26 14:46:39");



DROP TABLE userlog;

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userIp` varbinary(16) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `loginTime` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO userlog VALUES("1","10","test@gmail.com","","","","2016-06-22 06:16:42");
INSERT INTO userlog VALUES("2","10","test@gmail.com","","","","2016-06-24 11:20:28");
INSERT INTO userlog VALUES("4","10","test@gmail.com","::1","","","2016-06-24 11:22:47");
INSERT INTO userlog VALUES("5","10","test@gmail.com","::1","","","2016-06-26 15:37:40");
INSERT INTO userlog VALUES("6","20","Benjamin@gmail.com","::1","","","2016-06-26 16:40:57");
INSERT INTO userlog VALUES("7","10","test@gmail.com","192.168.43.11","","","2020-06-25 07:53:26");
INSERT INTO userlog VALUES("8","10","test@gmail.com","192.168.43.1","","","2020-06-25 07:53:27");
INSERT INTO userlog VALUES("9","10","test@gmail.com","::1","","","2020-06-25 07:54:21");
INSERT INTO userlog VALUES("10","22","kiran@gmail.com","::1","","","2020-06-25 08:19:09");



DROP TABLE userregistration;

CREATE TABLE `userregistration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regNo` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `contactNo` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(45) NOT NULL,
  `passUdateDate` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

INSERT INTO userregistration VALUES("10","108061211","Hit ","that","like button","male","9806597535","test@gmail.com","Test@123","2016-06-22 04:21:33","25-06-2020 01:24:59","22-06-2016 05:16:49");
INSERT INTO userregistration VALUES("19","102355","Harry","projects","Singh","male","6786786786","Harry@gmail.com","6786786786","2016-06-26 16:33:36","","");
INSERT INTO userregistration VALUES("20","586952","Benjamin","","projects","male","8596185625","Benjamin@gmail.com","8596185625","2016-06-26 16:40:07","","");
INSERT INTO userregistration VALUES("21","7676","vanja","","twaake","male","9806597535","vanja@gmail.com","9806597535","2020-06-25 07:50:51","","");
INSERT INTO userregistration VALUES("22","7676","kiran","","adk","others","9806597535","kiran@gmail.com","kiran","2020-06-25 07:59:30","","");



