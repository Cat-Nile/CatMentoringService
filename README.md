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
  
![스크린샷 2022-08-31 시간: 02 39 35](https://user-images.githubusercontent.com/107024591/187506223-6f39cefc-8da0-4b34-981c-b59a4be419ad.png)
</div>

  
<div align="left">
- 고양이 회원가입
  
![스크린샷 2022-08-31 시간: 01 23 44](https://user-images.githubusercontent.com/107024591/187504625-f45df979-fe53-4b24-966d-d69b775cd23e.png)
</div>
<div align="left">
- 고양이 로그인(토큰 값 조회)
  
![스크린샷 2022-08-31 시간: 01 26 51](https://user-images.githubusercontent.com/107024591/187504631-cf1e0739-cf8b-44ed-bf6b-7c4b3fd8718e.png)
</div>
<div align="left">
- 질문 목록 조회
  
![스크린샷 2022-08-31 시간: 01 17 43](https://user-images.githubusercontent.com/107024591/187504618-a6846870-778e-4c1b-9ad9-7927f9b483b4.png)  
</div>
<div align="left">
- 질문 단건 조회
  
![스크린샷 2022-08-31 시간: 01 28 13](https://user-images.githubusercontent.com/107024591/187504635-40e7d067-1331-4c50-80cf-4b99dcf183ef.png)  
</div>
<div align="left">
- 질문 생성
  
![스크린샷 2022-08-31 시간: 01 29 59](https://user-images.githubusercontent.com/107024591/187504640-dc4dcdc9-d58b-45f1-a342-99661c5b3c35.png)  
</div>
<div align="left">
- 질문 수정
  
![스크린샷 2022-08-31 시간: 01 30 55](https://user-images.githubusercontent.com/107024591/187504642-1812237b-2ac7-4419-8405-96c979bd01d6.png)  
</div>
<div align="left">
- 질문 삭제  
  
![스크린샷 2022-08-31 시간: 01 31 29](https://user-images.githubusercontent.com/107024591/187504643-a2357aff-ac66-4603-9a97-e768cc0ce5cb.png)  
</div>
<div align="left">
- 답글 생성  
  
![스크린샷 2022-08-31 시간: 01 35 56](https://user-images.githubusercontent.com/107024591/187504651-7223f4cf-ba1a-49c4-b020-bcbd4ad1559e.png)  
</div>
<div align="left">
- 답글 수정
  
![스크린샷 2022-08-31 시간: 02 23 27](https://user-images.githubusercontent.com/107024591/187504652-55c6ac78-fca1-4cbd-8ca2-6333d7865019.png)  
</div>

<div align="left">
- 답글 삭제  
  
![스크린샷 2022-08-31 시간: 02 25 15](https://user-images.githubusercontent.com/107024591/187504655-19cec577-9eee-4fc5-874f-986984defa14.png)  
</div>



## 기술 스택

> - Back-End :  <img src="https://img.shields.io/badge/PHP-777BB4?style=flat&logo=php&logoColor=White"/>&nbsp;<img src="https://img.shields.io/badge/Laravel-FF2D20?style=flat&logo=laravel&logoColor=white"/>&nbsp;<img src="https://img.shields.io/badge/MySQL 8.0-4479A1.svg?style=flat&logo=mysql&logoColor=white"/>
>
> - ETC　　　:  <img src="https://img.shields.io/badge/Git-F05032?style=flat-badge&logo=Git&logoColor=white"/>&nbsp;<img src="https://img.shields.io/badge/Github-181717?style=flat-badge&logo=Github&logoColor=white"/>&nbsp;<img src="https://img.shields.io/badge/Insomnia-4000BF?style=flat-badge&logo=Insomnia&logoColor=white"/>&nbsp;