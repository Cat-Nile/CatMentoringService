<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 고양이 온라인 익명 멘토링 서비스
 <h2>⌛ 개발 기간</h2> 
 2022/08/25 ~ 2022/08/30

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start.

You have to follow this MySQL Settings(**Very important!!**).
- user: root
- password: test1234
- database: laravel

To make new database, use this command
```mysql
create database laravel;
```

Clone the repository
```zsh
    git clone https://github.com/Cat-Nile/CatMentoringService.git
```
Switch to the repo folder
```zsh
    cd CatMentoringService
```
Install all the dependencies using composer
```zsh
    composer install
```
Copy the example env file and make the required configuration changes in the .env file
```zsh
    cp .env.example .env
```
Run the database migrations (**Set the database connection in .env before migrating**)
```zsh
    php artisan migrate:refresh --seed
```
Start the local development server
```zsh
    php artisan serve
```

You can now access the server at http://localhost:8000

  
## 기획
고양이 멘토가 멘티들에게 익명 멘토링을 해주는 서비스를 제작하려고 합니다.
<br><br>
**질문 (예시)**

- 제목: 집사에 대한 질문입니다.
- 내용: 제가 먼치킨 고양이인데 집사가 다리짧다고 놀리는데 냥냥펀치 날려야 할까요?
- 질문 타입: 집사후기

**답변 (예시)**

- 내용: 츄르주면 용서하는데 안 줬다면 날려도 무죄입니다.
- 채택 여부: Y/N

**유저(고양이) 정보 (예시)**

- 품종: 먼치킨
- 나이: 10살
- 털 색깔/무늬: 삼색
- 유저 형태: 멘토


## 데이터

**질문 타입 종류**
- 사료
- 그루밍
- 집사 후기

**유저(고양이) 정보 - 품종 종류**
- 터키쉬 앙고라
- 샴
- 스코티쉬 폴드
- 러시안 블루
- 먼치킨
- 코리안 숏헤어
- 스노우슈

**유저(고양이) 정보 - 나이 종류 (민감한 정보입니다.)**
- 1살 ~ 15살

**유저(고양이) 정보 - 털 색깔/무늬 종류**
- 흰색
- 회색
- 검정색
- 삼색
- 턱시도
- 고등어
- 치즈

**유저(고양이) 정보 - 유저 형태 종류**
- 멘토
- 멘티


## 개발 조건

1. **유저(고양이) 정보 받아오기 - 비회원 조회 불가**
    - 품종
    - 나이
    - 털색깔/무늬
    - 유저형태
2. **질문 가져오기 - 비회원 조회 가능**
    - 제목
    - 내용 (전체 내용이 아닌 처음 20글자만 가져오기)
    - 작성 날짜
    - 유저 정보 (민감 정보 제외)
    
    ***pagination 1page당 9개의 아이템***
    
3. **질문과 답변 가져오기 - 비회원 조회 가능**
    - 제목
    - 내용
    - 작성 날짜
    - 유저 정보 (민감정보 제외)
    - 답변 리스트
        - 답변 내용
        - 답변 채택 여부
        - 답변 날짜
        - 답변자 유저 정보 (민감정보 제외)
4. **질문 등록**
    - 질문은 제목, 내용, 질문 타입이 꼭 입력되어야 합니다.
5. **질문 삭제**
    - 질문에 답변이 달린 이후에는 삭제가 불가합니다.
6. **질문 수정**
    - 질문에 답변이 달린 이후에는 수정이 불가합니다.
7. **답변 작성**
    - 답변이 3개 이상 달린 경우 작성이 불가합니다.
8. **답변 수정**
    - 해당 답변이 채택된 이후엔 수정이 불가합니다.
9. **답변 삭제**
    - 해당 답변이 채택된 이후엔 삭제가 불가합니다.

### API 명세서


| ID  | URI                                                 | METHOD     | 기능           |
|-----|-----------------------------------------------------|------------|---------------|
| 1   | /api/posts                                          | POST       | 질문 생성       |
| 2   | /api/posts                                          | GET        | 질문 목록 조회   |
| 3   | /api/posts/<int:postid>                             | GET        | 질문 단건 조회   |
| 4   | /api/posts/<int:postid>                             | PATCH      | 질문 수정       |
| 5   | /api/posts/<int:postid>                             | DELETE     | 질문 삭제       |
| 6   | /api/posts/<int:postid>/comments                    | POST       | 답글 생성       |
| 7   | /api/posts/<int:postid>/comments/<int:commentid>    | PATCH      | 답글 수정       |
| 8   | /api/posts/<int:postid>/comments/<int:commentid>    | DELETE     | 답글 삭제       |
| 9   | /api/sign-up                                        | POST       | 회원가입        |
| 10  | /api/sign-in                                        | POST       | 로그인         |
| 11  | /api/users                                          | GET        | 고양이 회원 조회 |
-----------------------------------------------------------------------------------------
<br><br>

## API 예시

<div align="left">
- 고양이 회원목록 조회
  
![고양이회원목록조회](https://user-images.githubusercontent.com/107024591/187538821-993ad54f-2633-42a1-aa25-d4605b399537.png)
</div>

  
<div align="left">
- 고양이 회원가입
  
![회원가입](https://user-images.githubusercontent.com/107024591/187538855-a2932fc6-ad39-4b46-8e8d-e1d82f6d329c.png)
</div>
<div align="left">
- 고양이 로그인(토큰 값 조회)
  
![로그인](https://user-images.githubusercontent.com/107024591/187538840-4cd49ef8-579e-4104-aee3-ac702f2e378b.png)
</div>
<div align="left">
- 질문 목록 조회
  
![질문목록조회](https://user-images.githubusercontent.com/107024591/187538849-45044daf-bb03-4c0e-b384-a7fe95a177d7.png)
</div>
<div align="left">
- 질문 단건 조회
  
![질문단건조회](https://user-images.githubusercontent.com/107024591/187538843-b01d0f19-82bc-4a6a-9212-1b907495decd.png)
</div>
<div align="left">
- 질문 생성
  
![질문생성](https://user-images.githubusercontent.com/107024591/187538847-51466e82-459a-46cc-9a49-40583add90bc.png)
</div>
<div align="left">
- 질문 수정
  
![질문수정](https://user-images.githubusercontent.com/107024591/187538848-66e0ccd0-b9c1-4a68-98e1-c1d4a154cb27.png) 
</div>
<div align="left">
- 질문 삭제  
  
![질문삭제](https://user-images.githubusercontent.com/107024591/187539908-1019775b-ea75-4834-88fe-806a02871b26.png)
</div>
<div align="left">
- 답글 생성  
  
![답글생성](https://user-images.githubusercontent.com/107024591/187538832-4f19da4f-0032-45b7-8046-14ccb2994e6a.png)
</div>
<div align="left">
- 답글 수정
  
![답글수정](https://user-images.githubusercontent.com/107024591/187538837-fd20daec-db26-4b31-bdff-5589b2b198b3.png)
</div>

<div align="left">
- 답글 삭제  
  
![답글삭제](https://user-images.githubusercontent.com/107024591/187538828-6a566f1e-42d7-4396-886f-5c6eff9c3bae.png)
</div>

----
#### 데이터 제약조건   
<div align="left">
- 답글이 달린 경우, 질문 삭제 불가  
  
![답글달린_질문은_삭제불가](https://user-images.githubusercontent.com/107024591/187538827-0dfda5a4-aa34-411a-b979-3ec5fd4bd1a9.png)  
</div>
<div align="left">
- 답글 3개 초과 등록 시, 추가 작성 불가  
  
![답글3개_초과시_추가작성불가](https://user-images.githubusercontent.com/107024591/187538825-23de0d0e-2985-4c52-b096-885246e1470e.png)    
</div>
<div align="left">
- 채택된 답글은 수정, 삭제 불가  
  
![채택답글은_수정_삭제_불가](https://user-images.githubusercontent.com/107024591/187538851-789a66f7-deaf-405d-aa0d-61dfbe3465ea.png)  
</div>
<div align="left">
- 페이지네이션 적용(페이지 당 9개)  
  
![페이지네이션9](https://user-images.githubusercontent.com/107024591/187538853-1ca83d20-2241-4062-815f-9a7c6102a8d8.png)  
</div>
  
## 기술 스택

> - Back-End :  <img src="https://img.shields.io/badge/PHP-777BB4?style=flat&logo=php&logoColor=White"/>&nbsp;<img src="https://img.shields.io/badge/Laravel-FF2D20?style=flat&logo=laravel&logoColor=white"/>&nbsp;<img src="https://img.shields.io/badge/MySQL 8.0-4479A1.svg?style=flat&logo=mysql&logoColor=white"/>
>
> - ETC　　　:  <img src="https://img.shields.io/badge/Git-F05032?style=flat-badge&logo=Git&logoColor=white"/>&nbsp;<img src="https://img.shields.io/badge/Github-181717?style=flat-badge&logo=Github&logoColor=white"/>&nbsp;<img src="https://img.shields.io/badge/Insomnia-4000BF?style=flat-badge&logo=Insomnia&logoColor=white"/>&nbsp;<img src="https://img.shields.io/badge/VisualStudioCode-007ACC?style=flat-badge&logo=VisualStudioCode&logoColor=white"/>&nbsp;