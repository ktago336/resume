#include <iostream>
#include<locale.h>
#include <conio.h>
#include<string>
#include<windows.h>
#include <filesystem>
#include <experimental/filesystem>
#include<fstream>
using namespace std;

string player1()
{
    SetConsoleCP(1251);
    SetConsoleOutputCP(1251);
    string word;
    system("cls");
    cout << "Введите слово\n";
    cin >> word;
    ofstream slovo;
    slovo.open("word.txt");
    slovo << word;
    slovo.close();
    //sendData();
    return word;
}
void player2(string X)
{
    /*getData();*/
    X = '0';
    ifstream Xw("word.txt");
    Xw >> X;
    Xw.close();
    bool win;
    int bik, kor, hod=1;
    string Guess;
    win = 0;
    cout << "Длина загадангого слова " << X.length() << " символов\n";
    cout << "Введите догадку а затем нажмите enter\n";
    while (win==0)
    {
        bik = 0;
        kor = 0;
        cin >> Guess;
        if (Guess.length() == X.length())
        {
            for (int i = 0; i < X.length(); i++)
                if (Guess[i] == X[i])
                    bik++;
            for (int i = 0; i < X.length(); i++)
            {
                for (int j = 0; j < X.length(); j++)
                {
                    if (Guess[i] == X[j] && i != j)
                        kor++;
                }
            }
            cout << "\t быков " << bik << " коров " << kor << "\n";
            if (bik == X.length())
            {
                cout << "Вы угадали слово и потратили на это " << hod << " ходов\n Введите ваше имя\n";
                string winner;
                cin >> winner;
                ofstream winF;
                winF.open("resultW.txt");
                winF << winner;
                winF.close();
                winF.open("resultH.txt");
                winF << hod;
                winF.close();
                /*sendData();*/
                system("cls");

                win = 1;
            }
            hod++;
        }
        else cout << "неверное количество букв\n";
    }
}
void game()
{
    string Xword;
    system("cls");
    Menu:
    std::cout << "Выберите игрока\n1.Загадываю\n2.Отгадываю\n3.Обновить слово\n4.Узнать результат соперника\n5.Назад";
    char choice;
    choice = _getch();
    switch (choice)
    {
    case '1': {
        Xword=player1();
        system("cls");
        goto Menu;
    } break;
    case '2':player2(Xword); break;
    case '3': /*getData*/; goto Menu; break;
    case '4': 
    {
        /*getData();*/
        string winner, hod;
        ifstream Xw("resultW.txt");
        Xw >> winner;
        Xw.close();
        ifstream XH("resultH.txt");
        XH >> hod;
        XH.close();
        cout << "\n" << "Игрок " << winner<<" потратил "<< hod<<" ходов";
        cout <<"\n any key to go back";
        _getch();
        system("cls");
        goto Menu;
        break;
    }
    case '5': return; break;
    default: system("cls"); goto Menu;
        break;
    }
}
int main()
{
    //system("ftp -s:connect.txt");
    //system("pause");
    //system("ftp -i -s:connect.bat");
    //system("cls");
    setlocale(LC_ALL, "Russian");
Menu:
    std::cout << "\t\t\t БЫКИ И КОРОВЫ\n1.Играть\n2.Правила\n3.Выйти\n";
    char choice;
    choice = _getch();
    switch (choice)
    {
    case '1': game(); system("cls"); goto Menu; break;
    case '2':
    {
        system("cls");
        cout << "Правила\n!Обязательно корректно выходите из программы!\nЗагадывающий придумывает слово, отгадывающий делает предположение\nколичество коров есть количество букв которые загадал 1 игрок, но они не на своем месте,\nколичество быков есть количество букв которые есть в исходном слове и они на своем месте,\nцель: угадать слово, удачи! \n any key to go back";
        _getch();
        system("cls");
        goto Menu;

    }break;
    case '3': remove("word.txt"); system("disconnect.bat"); break;
    default: system("cls"); goto Menu;
        break;
    }
}
