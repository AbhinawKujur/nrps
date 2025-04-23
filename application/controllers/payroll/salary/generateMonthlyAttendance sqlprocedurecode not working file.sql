CREATE DEFINER=`root`@`localhost` PROCEDURE `generateMonthlyAttendance`(IN `start_cycle` INT, IN `end_cycle` INT, IN `weekend_date` TEXT, IN `current_month_total_days` INT, IN `current_month` INT, IN `current_month_year` INT, IN `prev_month_total_days` INT, IN `prev_month` INT, IN `prev_month_year` INT, IN `emp_id` VARCHAR(50), IN `created_by` VARCHAR(50), IN `emp_tbl_id` INT)
BEGIN
 DECLARE checkAlreadyExist,checkHoliday int;
 DECLARE checkDateExist int;
 DECLARE TOTAL_DURATION,total_work_duration varchar(255);
 DECLARE SHIFT_DURATION varchar(255);
 DECLARE MIN_HRS_FULL,leaveCode varchar(255);
 DECLARE MIN_HRS_HALF varchar(255);
     
 DECLARE presentCheck,checkWeekendDate int;
 DECLARE holidayCheck,leaveCheck,leave_type int;
 DECLARE p INT;
 DECLARE i INT;
 DECLARE custom_date date;

 DECLARE finished INTEGER DEFAULT 0;
 DECLARE empl_id,emp_table_id varchar(100) DEFAULT "";
 
  DEClARE curEmail 
    CURSOR FOR 
      SELECT EMPID,id FROM employee WHERE STATUS=1;
  DECLARE CONTINUE HANDLER 
        FOR NOT FOUND SET finished = 1;
 
    OPEN curEmail;
  getEmail: LOOP
  FETCH curEmail INTO empl_id,emp_table_id;
  IF finished = 1 THEN 
      LEAVE getEmail;
  END IF;

   SET p = start_cycle;
   WHILE p <= prev_month_total_days DO
     SET custom_date = CONCAT(prev_month_year,'-',prev_month,'-',p);
     SET checkWeekendDate = 0;
     SELECT count(*) INTO checkDateExist FROM  monthly_emp_atten WHERE empid=empl_id AND date(att_date)=custom_date;
     IF(checkDateExist <= 0) THEN
       SELECT count(*) INTO checkHoliday FROM  holiday_master WHERE date(FROM_DATE) <= custom_date AND date(TO_DATE) >=custom_date AND APPLIED_FOR IN (0,1);
               
       SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TOTAL_DURATION))), max(SHIFT_DURATION), MAX(MIN_HRS_FULL), MAX(MIN_HRS_HALF) INTO TOTAL_DURATION,SHIFT_DURATION,MIN_HRS_FULL,MIN_HRS_HALF FROM  emp_attendance WHERE EMPLOYEE_ID=emp_table_id AND date(IN_TIME)=custom_date;
               
       IF(checkHoliday > 0 OR (SELECT FIND_IN_SET(custom_date, weekend_date) > 0)) THEN
         IF(TOTAL_DURATION IS NOT NULL AND SHIFT_DURATION IS NOT NULL) THEN
           INSERT INTO monthly_emp_atten(empid,att_year,att_month,att_date,att_status,created_by) VALUES (empl_id,current_month_year,current_month,custom_date,'P',created_by);
         ELSE
           INSERT INTO monthly_emp_atten(empid,att_year,att_month,att_date,att_status,created_by) VALUES (empl_id,current_month_year,current_month,custom_date,'H',created_by);
         END IF;
       ELSE
           SELECT LEAVE_TYPE,COUNT(*) INTO leave_type,leaveCheck FROM emp_leave_attendance WHERE EMPLOYEE_ID=empl_id AND date(DATE_FROM)<=custom_date AND date(DATE_TO)>=custom_date AND STATUS=1;
           IF(leave_type = 1) THEN
                 SET leaveCode='CL';
           ELSEIF(leave_type = 2) THEN
                 SET leaveCode='ML';
           ELSEIF(leave_type = 3) THEN
                 SET leaveCode='EL';
           ELSEIF(leave_type = 4) THEN
                 SET leaveCode='LWP';
           ELSEIF(leave_type = 5) THEN
                 SET leaveCode='DDL';
           ELSEIF(leave_type = 6) THEN
                 SET leaveCode='HPL';
           ELSE  
               SET leaveCode='';
           END IF;
                       
           IF(TOTAL_DURATION IS NOT NULL AND SHIFT_DURATION IS NOT NULL) THEN
             IF(TOTAL_DRUATION IS NULL) THEN
               SET total_work_duration = SHIFT_DURATION;
             ELSE
               SET total_work_duration = TOTAL_DRUATION;
             END IF;
               
             IF(leaveCheck > 0) THEN
               INSERT INTO monthly_emp_atten(empid,att_year,att_month,att_date,att_status,created_by) VALUES (empl_id,current_month_year,current_month,custom_date,leaveCode,created_by);
             ELSEIF(TIME(TOTAL_DURATION)>=TIME(MIN_HRS_FULL))THEN                
               INSERT INTO monthly_emp_atten(empid,att_year,att_month,att_date,att_status,created_by) VALUES (empl_id,current_month_year,current_month,custom_date,'P',created_by);                    
             ELSEIF(TIME(TOTAL_DURATION)<=TIME(MIN_HRS_HALF))THEN
               INSERT INTO monthly_emp_atten(empid,att_year,att_month,att_date,att_status,created_by) VALUES (empl_id,current_month_year,current_month,custom_date,'HD',created_by);
             END IF;

           ELSEIF(leaveCheck > 0) THEN
             INSERT INTO monthly_emp_atten(empid,att_year,att_month,att_date,att_status,created_by) VALUES (empl_id,current_month_year,current_month,custom_date,leaveCode,created_by);
           ELSE
             INSERT INTO monthly_emp_atten(empid,att_year,att_month,att_date,att_status,created_by) VALUES (empl_id,current_month_year,current_month,custom_date,'AB',created_by);
           END IF;
         END IF;
     END IF;    
   SET p = p + 1;
   END WHILE;

   SET i = 1;
   WHILE i <= end_cycle DO
     SET custom_date = CONCAT(current_month_year,'-',current_month,'-',i);

     SET checkWeekendDate = 0;
     SELECT count(*) INTO checkDateExist FROM  monthly_emp_atten WHERE empid=empl_id AND date(att_date)=custom_date;
     IF(checkDateExist <= 0) THEN
       SELECT count(*) INTO checkHoliday FROM  holiday_master WHERE date(FROM_DATE) <= custom_date AND date(TO_DATE) >=custom_date AND APPLIED_FOR IN (0,1);
               
       SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TOTAL_DURATION))), max(SHIFT_DURATION), MAX(MIN_HRS_FULL), MAX(MIN_HRS_HALF) INTO TOTAL_DURATION,SHIFT_DURATION,MIN_HRS_FULL,MIN_HRS_HALF FROM  emp_attendance WHERE EMPLOYEE_ID=emp_table_id AND date(IN_TIME)=custom_date;
               
       IF(checkHoliday > 0 OR (SELECT FIND_IN_SET(custom_date, weekend_date) > 0)) THEN
         IF(TOTAL_DURATION IS NOT NULL AND SHIFT_DURATION IS NOT NULL) THEN
           INSERT INTO monthly_emp_atten(empid,att_year,att_month,att_date,att_status,created_by) VALUES (empl_id,current_month_year,current_month,custom_date,'P',created_by);
        ELSE
           INSERT INTO monthly_emp_atten(empid,att_year,att_month,att_date,att_status,created_by) VALUES (empl_id,current_month_year,current_month,custom_date,'H',created_by);
         END IF;
       ELSE
           SELECT LEAVE_TYPE,COUNT(*) INTO leave_type,leaveCheck FROM emp_leave_attendance WHERE EMPLOYEE_ID=empl_id AND date(DATE_FROM)<=custom_date AND date(DATE_TO)>=custom_date AND STATUS=1;
           IF(leave_type = 1) THEN
                 SET leaveCode='CL';
           ELSEIF(leave_type = 2) THEN
                 SET leaveCode='ML';
           ELSEIF(leave_type = 3) THEN
                 SET leaveCode='EL';
           ELSEIF(leave_type = 4) THEN
                 SET leaveCode='LWP';
           ELSEIF(leave_type = 5) THEN
                 SET leaveCode='DDL';
           ELSEIF(leave_type = 6) THEN
                 SET leaveCode='HPL';
           ELSE  
               SET leaveCode='';
           END IF;
                       
           IF(TOTAL_DURATION IS NOT NULL AND SHIFT_DURATION IS NOT NULL) THEN
             IF(TOTAL_DRUATION IS NULL) THEN
               SET total_work_duration = SHIFT_DURATION;
             ELSE
               SET total_work_duration = TOTAL_DRUATION;
             END IF;
               
             IF(leaveCheck > 0) THEN
               INSERT INTO monthly_emp_atten(empid,att_year,att_month,att_date,att_status,created_by) VALUES (empl_id,current_month_year,current_month,custom_date,leaveCode,created_by);
             ELSEIF(TIME(TOTAL_DURATION)>=TIME(MIN_HRS_FULL))THEN                
               INSERT INTO monthly_emp_atten(empid,att_year,att_month,att_date,att_status,created_by) VALUES (empl_id,current_month_year,current_month,custom_date,'P',created_by);                    
             ELSEIF(TIME(TOTAL_DURATION)<=TIME(MIN_HRS_HALF))THEN
               INSERT INTO monthly_emp_atten(empid,att_year,att_month,att_date,att_status,created_by) VALUES (empl_id,current_month_year,current_month,custom_date,'HD',created_by);
             END IF;

           ELSEIF(leaveCheck > 0) THEN
             INSERT INTO monthly_emp_atten(empid,att_year,att_month,att_date,att_status,created_by) VALUES (empl_id,current_month_year,current_month,custom_date,leaveCode,created_by);
           ELSE
             INSERT INTO monthly_emp_atten(empid,att_year,att_month,att_date,att_status,created_by) VALUES (empl_id,current_month_year,current_month,custom_date,'AB',created_by);
           END IF;
         END IF;
     END IF;    
   SET i= i + 1;
   END WHILE;   
  END LOOP getEmail;
  CLOSE curEmail; 
END