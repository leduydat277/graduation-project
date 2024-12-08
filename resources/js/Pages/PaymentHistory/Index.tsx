import React from "react";
import MainLayout2 from "@/Layouts/MainLayout2";
import { usePromiseFn } from "../../../service/hooks/promise";
import { allPayment } from "../../../service/hooks/payment";
import { formatPrice } from "../../../service/hooks/price";
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table";

const keyToDisplayName = {
    dichvuphatsinh: "Dịch Vụ Phát Sinh",
    tienphatsinh: "Tiền Phát Sinh",
    phiphatsinh: "Phí Phát Sinh",
    solanthanhtoan: "Số Lần Thanh Toán",
    sotienmoilanthanhtoan: "Số Tiền Mỗi Lần Thanh Toán",
    tiencoc: "Tiền Cọc",
    tienphong: "Tiền Phòng",
    tongtiendathanhtoan: 'Tổng Tiền Thanh Toán',
    trangthai: "Trạng Thái",
};

function PaymentHistory() {
    const { data, error, loading } = usePromiseFn(allPayment, []);


    const payments = data?.data || {}
    console.log("payments", payments);


    const paymentArray = Object.values(payments);


    if (!paymentArray.length) {
        return <p>No payment history available.</p>;
    }

    return (
        <Table  style={{ paddingTop: 6 }}>
            <TableCaption>Lịch sử thanh toán gần đây của bạn.</TableCaption>
            <TableHeader>
                <TableRow>
                <TableHead>Thứ Tự</TableHead>
                    {Object.keys(paymentArray[0]).map((key, index) => (
                        
                        <TableHead key={index} >
                            {keyToDisplayName[key] || key}
                        </TableHead>
                    ))}
                </TableRow>
            </TableHeader>
            <TableBody>
                {paymentArray.map((payment, index) => (
                    <TableRow key={index}>
                        <TableCell className="text-center">{index + 1}</TableCell>
                        {Object.entries(payment).map(([key, value], subIndex) => (
                            <TableCell
                                key={subIndex}
                                // className="text-center"
                            >
                                {Array.isArray(value) ? (

                                    value.length > 0 ? (
                                        key === "sotienmoilanthanhtoan" ? (
                                            value.map((v, i) => <div key={i}>{formatPrice(v)}</div>)
                                        ) : key === "phiphatsinh" ? (
                                            value.map((item, i) => (
                                                <div key={i}>
                                                    {Object.entries(item).map(([subKey, subValue]) => (
                                                        <div key={subKey}>
                                                            {keyToDisplayName[subKey] || subKey}:{" "}
                                                            {subKey === "tienphatsinh"
                                                                ? formatPrice(subValue)
                                                                : subValue}
                                                        </div>
                                                    ))}
                                                </div>
                                            ))
                                        ) : (
                                            <div>
                                                {value.map((v, i) => (
                                                    <div key={i}>{JSON.stringify(v)}</div>
                                                ))}
                                            </div>
                                        )
                                    ) : (
                                        "Không có dữ liệu"
                                    )
                                ) : typeof value === "number" || typeof value === "string" ? (
                                    key === "tienphong" || key === "tiencoc"
                                        ? formatPrice(value)
                                        : value
                                ) : (
                                    JSON.stringify(value)
                                )}
                            </TableCell>
                        ))}
                    </TableRow>
                ))}
            </TableBody>
        </Table>
    );
}

PaymentHistory.layout = (page: React.ReactNode) => <MainLayout2>{page}</MainLayout2>;

export default PaymentHistory;
