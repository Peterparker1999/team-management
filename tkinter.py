from tkinter import *
from tkinter.messagebox import *
''' from tkinter.ttk import *
root=Tk()
root.geometry('100x100')
a=Label(root, text="Hello, world!")
btn=Button(root, text='Click Me..!!',command=root.destroy) 
btn.pack(side='top')
a.pack()
root.mainloop() '''

root=Tk()

def show():
    showinfo("showinfo","Welcome to my Page")

name1=StringVar()
passwd=StringVar()
def submit():
    name=name1.get()
    password=passwd.get()
    if(name=='ram' and password=='sita'):
        showinfo("showinfo", "Welcome to my Page")
    else:
        showinfo("showinfo", "Try again.....")
    #print("The name is : "+name)
    #print("The password is : "+password)
    name1.set('')
    passwd.set('')
root.geometry('500x500')
root.title("Heya")
u=Label(root, text="User Name: ")
p=Label(root, text="Password: ")

un = Entry(root,textvariable=name1,bg='navy',fg='white')
pw = Entry(root,textvariable=passwd,show='*')

btn=Button(root, text='Login',bd='5',command=submit)

u.pack()
un.pack()
p.pack()
pw.pack()
btn.pack()

root.mainloop()

'''
btn=Button(root, text='Click Me..!!',bd='5',command=show)
btn1=Button(root, text='Exit',bd='5',command=root.destroy)
btn1.pack(side='bottom')
btn.pack(side='top')
a.pack()
root.mainloop()

'''
