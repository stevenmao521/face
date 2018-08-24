Student(s#,sname,sage,ssex) 学生表  
Course(c#,cname,T#) 课程表 
SC(s#,c#,score) 成绩表 
Teacher(T#,Tname) 教师表
问题： 

select s# from (select s#,score from sc where c#='001') a,(select s#,score from sc where c#='002') b
where a.score>b.score and a.s#=b.s#

2、查询平均成绩大于60分的同学的学号和平均成绩； 
select s#,avg(score) 