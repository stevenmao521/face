sql练习
https://blog.csdn.net/xuebing1995/article/details/74614896

student(sid,sname,sage,ssex) 学生表  
course(cid,cname,tid) 课程表 
sc(sid,cid,score) 成绩表 
teacher(tid,tname) 教师表

问题： 
1、查询“001”课程比“002”课程成绩高的所有学生的学号；
select a.sid from (select sid from sc where cid='001')  a,
(select sid from score where cid='002') b
where a.sid=b.sid and a.score>b.score

2、查询平均成绩大于60分的同学的学号和平均成绩； 
select sid,avg(score) from sc 
group by sid
having avg(score)>60

3.查询所有同学的学号、姓名、选课数、总成绩；
select student.sid,student.sname,count(sc.cid),sum(sc.score)
from student left outer join sc on student.sid=sc.sid
group by student.sid,student.sname

4、查询姓“李”的老师的个数；
select count(distinct(tname)) from
teacher where tname like '李%'

5、查询没学过“刘阳”老师课的同学的学号、姓名；
select student.sid,student.sname from student
where sid not in(
select distinct(sc.sid) from sc,course,teacher where sc.cid=course.cid and course.tid=teacher.tid and teacher.tname='刘阳'
)

6、查询学过“001”并且也学过编号“002”课程的同学的学号、姓名；[exists的返回结果是bool型，只有true或者false]

select student.sid,student.sname from student,sc where student.sid=sc.sid and sc.cid='c001' and
exists(select sc2.sid,sc2.cid from sc as sc2 where sc2.sid=sc.sid and sc2.cid='c002')

7、查询学过“刘阳”老师所教的所有课的同学的学号、姓名；

select sid,sname from student where sid IN(
select sc.sid from sc,course,teacher where sc.cid=course.cid and course.tid=teacher.tid and teacher.tname='谌燕' group by sc.sid having count(sc.cid)=
(select count(course.cid) from course,teacher where course.tid=teacher.tid and teacher.tname='谌燕')
)

8、查询课程编号“002”的成绩比课程编号“001”课程低的所有同学的学号、姓名；

select sid,sname from student where (
(select score from sc where sc.sid=student.sid and sc.cid='c001')<
(select score from sc where sc.sid=student.sid and sc.cid='c002')
)
