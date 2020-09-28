import xlrd,xlwt,sys,urllib.parse,io,json
data=xlrd.open_workbook(sys.argv[1])
RExcel=xlwt.Workbook()
sheets=data.sheet_names()
dataArr = []
for sheet in sheets:
    RBook=RExcel.add_sheet(sheet)

    if data.sheet_loaded(sheet):
        sheetObj=data.sheet_by_name(sheet)
        nrows=sheetObj.nrows
        ncols=sheetObj.ncols
        i=j=0
        while i<nrows:
            dataRow = []
            j=0
            while j<ncols:
                RBook.write(i,j,sheetObj.cell_value(i,j))
                dataRow.append(sheetObj.cell_value(i, j))
                j=j+1
            i=i+1
            dataArr.append(dataRow)
    else:
        print(sheet+"没有加载")
#RExcel.save("我的.xls")
sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')
print(json.dumps(dataArr))