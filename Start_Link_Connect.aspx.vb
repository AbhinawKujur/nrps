Imports Microsoft.VisualBasic
Imports System.Data.SqlClient
Imports System.Net
Imports System.Data
Imports System.Net.Mail
Imports System.IO
Imports System.Net.NetworkInformation
Imports System.Configuration
Partial Class Start_Link_Connect
    Inherits System.Web.UI.Page
    Public rs As SqlDataReader
    Public rs1 As SqlDataReader
    Public conn As New Odbc.OdbcConnection
    Dim sqlservercon As New SqlConnection(ConfigurationManager.ConnectionStrings("SqlServerServices").ConnectionString)
    Dim mysqlservercon As New System.Data.Odbc.OdbcConnection(ConfigurationManager.ConnectionStrings("mysqlConnectionString").ConnectionString)
    Dim dt As New DataTable
    Protected Sub Page_Load(sender As Object, e As EventArgs) Handles Me.Load
        Try
            If Not Page.IsPostBack Then
                GridView1.DataSource = Me.Get_user_employee_list()
                GridView1.DataBind()
                GridView2.DataSource = Me.Get_user_employee_listMysql()
                GridView2.DataBind()
                dt = Me.Get_user_employee_list()
                Dim i As Integer
                i = 0
                While i < dt.Rows.Count
                    Me.insert_punching_Data(dt.Rows(i).Item("CARDNO").ToString, dt.Rows(i).Item("OFFICEPUNCH").ToString, dt.Rows(i).Item("REASONCODE").ToString, dt.Rows(i).Item("PROCESS").ToString, dt.Rows(i).Item("PUNCHFLAG").ToString, dt.Rows(i).Item("MACHINEID").ToString, dt.Rows(i).Item("MACHINENO").ToString, dt.Rows(i).Item("PUNCHTYPE").ToString)
                    i = i + 1
                End While
                i = 0
            End If
        Catch ex As Exception

        End Try
    End Sub
    Public Function Get_user_employee_list()
        Dim dt As New Data.DataTable
        sqlservercon.Open()
        ' and Convert(date,OFFICEPUNCH)=@Start_Date
        Dim cmd1 As New Data.SqlClient.SqlCommand("Declare @Start_Date date set @Start_Date=(select CONVERT (date, SYSDATETIME())) Select CARDNO,OFFICEPUNCH,REASONCODE,PROCESS,PUNCHFLAG,MACHINEID,EDATE,MACHINENO,PUNCHTYPE,Latitude,Longitude from STARDC_RAWDATA where PROCESS='N'", sqlservercon)
        Dim myAdapter As New SqlDataAdapter(cmd1)
        myAdapter.Fill(dt)
        sqlservercon.Close()
        Return dt
    End Function
    Public Function Get_user_employee_listMysql()
        Dim dt As New Data.DataTable
        mysqlservercon.Open()
        Dim cmd1 As New Data.Odbc.OdbcCommand("Select * from Punching_raw_Data where Process='N'", mysqlservercon)
        Dim myAdapter As New Data.Odbc.OdbcDataAdapter(cmd1)
        myAdapter.Fill(dt)
        mysqlservercon.Close()
        Return dt
    End Function
    Public Sub insert_punching_Data(ByVal s1, ByVal s2, ByVal s3, ByVal s4, ByVal s5, ByVal s6, ByVal s7, ByVal s8)
        Dim lab1, lab2, lab3, lab4, lab5, lab6, lab7, lab8, lab9, lab10, lab11 As New Label
        lab1.Text = s1
        lab2.Text = s2
        lab3.Text = s3
        lab4.Text = s4
        lab5.Text = s5
        lab6.Text = s6
        lab7.Text = s7
        lab8.Text = s8
        mysqlservercon.Open()
        Dim cmd1 As New Data.Odbc.OdbcCommand("insert into punching_raw_data(CARDNO,OFFICEPUNCH,REASONCODE,PROCESS,PUNCHFLAG,MACHINEID,MACHINENO,PUNCHTYPE)values('" + lab1.Text + "','" + lab2.Text + "','" + lab3.Text + "','" + lab4.Text + "','" + lab5.Text + "','" + lab6.Text + "','" + lab7.Text + "','" + lab8.Text + "')", mysqlservercon)
        cmd1.ExecuteNonQuery()
        mysqlservercon.Close()
        sqlservercon.Open()
        Dim cmd2 As New Data.SqlClient.SqlCommand("Update STARDC_RAWDATA set PROCESS='Y' where PROCESS='N' and OFFICEPUNCH='" + lab2.Text + "' and CARDNO='" + lab1.Text + "'", sqlservercon)
        cmd2.ExecuteNonQuery()
        sqlservercon.Close()
    End Sub
End Class

